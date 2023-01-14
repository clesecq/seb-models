<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a transaction in the database
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::created(function ($transaction) {
            if (config('recalculate_for_all_transaction', true)) {
                $transaction->account->recalculate();
            }
        });
    }

    protected $casts = [
        'rectification' => 'boolean',
        'amount' => 'double'
    ];

    protected $fillable = [
        'name',
        'amount',
        'rectification',
        'user_id',
        'account_id',
        'category_id'
    ];

    /**
     * Get the account associated with this transaction
     *
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the category associated with this transaction
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }
}
