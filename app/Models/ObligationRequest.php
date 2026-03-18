<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class ObligationRequest extends Model
{
    protected $fillable = [
        'serial_number',
        'sub_code',
        'program_category',
        'procurement_plan_ppmp_id',
        'payee_payor_id',
        'requestor_user_id',
        'certified_box_a_user_id',
        'certified_box_b_user_id',
        'requested_amount',
        'status',
        'is_locked',
    ];

    protected $casts = [
        'requested_amount' => 'decimal:2',
        'is_locked' => 'boolean',
    ];

    public function ppmp(): BelongsTo
    {
        return $this->belongsTo(ProcurementPlanPpmp::class, 'procurement_plan_ppmp_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(ObligationDetail::class);
    }

    public function editRequests(): HasMany
    {
        return $this->hasMany(EditRequest::class);
    }

    protected static function booted()
    {
        static::updating(function ($obligation) {
            // 1. Security check: Only allow updates if not locked, OR if we are specifically unlocking/locking
            if ($obligation->is_locked && !$obligation->isDirty('is_locked')) {
                // In a real app, we'd throw an Exception here
                return false; 
            }

            // Box B point-of-deduction math
            if ($obligation->isDirty('status') && $obligation->status === 'Certified Box B') {
                // 1. Assign Serial Number if not already assigned
                if (!$obligation->serial_number || $obligation->serial_number === 'PENDING') {
                    $fundCode = $obligation->ppmp->fundCluster->code;
                    $fiscalYear = $obligation->ppmp->fiscal_year;
                    $obligation->serial_number = self::generateNextSerialNumber($fundCode, $fiscalYear);
                }

                // 2. Mathematically deduct from PPMP balances
                $obligation->deductFromPpmpBalances();

                // 3. Automatically lock the record
                $obligation->is_locked = true;
            }
        });
    }

    public static function generateNextSerialNumber($fundCode, $fiscalYear)
    {
        $prefix = ($fundCode === '101') ? 'ORS' : 'BURS';
        // Use last 2 digits of fiscal year
        $yearSuffix = substr((string)$fiscalYear, -2);
        
        // Find the last serial number for this year and prefix
        // Format: ORS-YY-XXXX
        $pattern = "{$prefix}-{$yearSuffix}-%";
        $last = self::where('serial_number', 'like', $pattern)
            ->orderBy('serial_number', 'desc')
            ->first();

        if (!$last) {
            $nextNum = 1;
        } else {
            // Extract the numeric part (last 4 digits)
            $parts = explode('-', $last->serial_number);
            $lastNum = (int) end($parts);
            $nextNum = $lastNum + 1;
        }

        return sprintf("%s-%s-%04d", $prefix, $yearSuffix, $nextNum);
    }

    public function deductFromPpmpBalances()
    {
        DB::transaction(function () {
            foreach ($this->details as $detail) {
                // Deduct from the specific PPMP Item balance
                $balance = PpmpBalance::where('ppmp_item_id', $detail->ppmp_item_id)->lockForUpdate()->first();
                
                if ($balance) {
                    $balance->obligated_amount += $detail->amount_charged; 
                    $balance->remaining_balance = $balance->total_allocated - $balance->obligated_amount;
                    $balance->save();
                }
            }
        });
    }
}
