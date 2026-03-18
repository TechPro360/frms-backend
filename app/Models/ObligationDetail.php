<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObligationDetail extends Model
{
    protected $fillable = [
        'obligation_request_id',
        'ppmp_item_id',
        'amount_charged',
        'description',
    ];

    public function obligationRequest(): BelongsTo
    {
        return $this->belongsTo(ObligationRequest::class);
    }

    public function ppmpItem(): BelongsTo
    {
        return $this->belongsTo(PpmpItem::class);
    }
}
