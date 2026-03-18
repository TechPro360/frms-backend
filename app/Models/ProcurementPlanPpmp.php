<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProcurementPlanPpmp extends Model
{
    protected $fillable = [
        'ppmp_number',
        'responsibility_center_id',
        'fund_cluster_id',
        'fiscal_year',
        'mfo_pap_code',
        'estimated_cost',
        'status',
        'parent_ppmp_id',
    ];

    public function fundCluster(): BelongsTo
    {
        return $this->belongsTo(FundCluster::class);
    }

    public function responsibilityCenter(): BelongsTo
    {
        return $this->belongsTo(ResponsibilityCenter::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PpmpItem::class);
    }
}
