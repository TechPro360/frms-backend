<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EditRequest extends Model
{
    protected $fillable = [
        'obligation_request_id',
        'requested_by_user_id',
        'reason',
        'status',
        'approved_by_user_id',
        'payload',
    ];

    protected $casts = [
        'payload' => 'json',
    ];

    public function obligationRequest(): BelongsTo
    {
        return $this->belongsTo(ObligationRequest::class);
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by_user_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }
}
