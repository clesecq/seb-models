<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Represent a member in the database
 */
class Member extends Model
{
    use HasFactory;

    protected $casts = [
        'paid' => 'boolean',
    ];

    protected $fillable = [
        'person_id',
    ];

    protected $appends = ['paid'];

    /**
     * Check if this member has paid
     */
    public function getPaidAttribute(): bool
    {
        return $this->transaction_id != null;
    }

    /**
     * Get the transaction associated with this member
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the person associated with this member
     */
    // phpcs:ignore
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Create a transaction when the member pays the fee
     */
    public function pay(): void
    {
        if ($this->transaction_id == null) {
            $message = Config::format(
                'members.contribution.transaction',
                ['member' => $this->person->attributesToArray()]
            );

            $this->transaction_id = Transaction::create([
                'name' => $message,
                'amount' => Config::number('members.contribution.amount'),
                'rectification' => false,
                'user_id' => Auth::id() ?? 1,
                'account_id' => Config::integer('members.contribution.account'),
                'category_id' => Config::integer('members.contribution.category'),
            ])->id;
            $this->save();
        }
    }

    /**
     * Archive this member
     *
     * @param  int|null  ...$params  year
     */
    public static function archive(?int ...$params): void
    {
        if (count($params) >= 1) {
            $year = $params[0];
        } else {
            $year = now()->year;
        }

        // We archive everything and empty the table
        foreach (Member::all() as $member) {
            ArchivedMember::create([
                'person_id' => $member->person_id,
                'transaction_id' => $member->transaction_id,
                'created_at' => $member->created_at,
                'updated_at' => $member->updated_at,
                'year' => $year,
            ]);
        }
        Member::truncate();
    }
}
