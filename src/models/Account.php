<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represent an account in the database
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        'name',
        'iban',
        'bic'
    ];

    protected $casts = [
        'balance' => 'double'
    ];

    /**
     * Get all transactions for this account
     * @return HasMany
     */
    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Recalculate the balance of this account and save it
     *
     * @return void
     */
    public function recalculate()
    {
        $this->balance = $this->transactions->sum('amount');
        $this->save();
    }

    /**
     * Recalculate the balance of all accounts using all transactions
     *
     * @return void
     */
    public static function recalculateAll()
    {
        foreach (static::all() as $account) {
            $account->recalculate();
        }
    }
}
