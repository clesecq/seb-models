<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represent an entry of config in the database
 */
class PersonalAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id'
    ];

    protected $casts = [
        'balance' => 'double'
    ];

    /**
     * Get the person associated with this personal account
     *
     * @return BelongsTo
     */
    // phpcs:ignore
    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the personal transactions associated with this personal account
     *
     * @return HasMany
     */
    // phpcs:ignore
    public function personal_transactions() : HasMany
    {
        return $this->hasMany(PersonalTransaction::class);
    }

    /**
     * Recalculate the balance of this personal account
     *
     * @return void
     */
    public function recalculate() : void
    {
        $this->balance = $this->personal_transactions->sum('amount');
        $this->save();
    }

    /**
     * Recalculate the balance of all personal accounts
     *
     * @return void
     */
    public static function recalculateAll() : void
    {
        foreach (static::all() as $account) {
            $account->recalculate();
        }
    }
}
