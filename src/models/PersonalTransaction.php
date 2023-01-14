<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a personal transaction in the database
 */
class PersonalTransaction extends Model
{
    use HasFactory;

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted() : void
    {
        static::created(function ($transaction) {
            if (config('recalculate_for_all_transaction', true)) {
                $transaction->personal_account->recalculate();
            }
        });
    }

    protected $casts = [
        'amount' => 'double'
    ];

    protected $fillable = [
        'amount',
        'user_id',
        'personal_account_id',
        'transaction_id'
    ];

    /**
     * Get the personal account associated with this personal transaction
     *
     * @return BelongsTo
     */
    // phpcs:ignore
    public function personal_account() : BelongsTo
    {
        return $this->belongsTo(PersonalAccount::class);
    }

    /**
     * Get the transaction associated with this personal transaction
     *
     * @return BelongsTo
     */
    // phpcs:ignore
    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
