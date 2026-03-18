<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpmpBalance extends Model
{
    protected $fillable = [
        'ppmp_item_id',
        'total_allocated',
        'obligated_amount',
        'remaining_balance',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(PpmpItem::class, 'ppmp_item_id');
    }
}
