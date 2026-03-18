<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpmpItem extends Model
{
    protected $fillable = [
        'procurement_plan_ppmp_id',
        'uacs_object_id',
        'item_name',
        'quantity',
        'unit_of_measure',
        'estimated_budget',
    ];

    public function ppmp(): BelongsTo
    {
        return $this->belongsTo(ProcurementPlanPpmp::class, 'procurement_plan_ppmp_id');
    }

    public function balance(): HasOne
    {
        return $this->hasOne(PpmpBalance::class);
    }
}
