<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FundCluster extends Model
{
    protected $fillable = ['code', 'name', 'resets_annually'];

    public function ppmps(): HasMany
    {
        return $this->hasMany(ProcurementPlanPpmp::class);
    }
}
