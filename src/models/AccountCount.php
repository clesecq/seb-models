<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent an account count in the database
 */
class AccountCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'type',
        'data',
        'balance'
    ];

    protected $casts = [
        'data' => 'array',
        'balance' => 'double'
    ];

    /**
     * Get the transaction associated with this account count
     *
     * @return BelongsTo
     */
    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
