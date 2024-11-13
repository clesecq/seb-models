<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Represent a person in the database
 */
class Person extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'discord_id',
    ];

    protected $hidden = [
        'edu_token',
    ];

    protected $appends = ['fullname', 'is_member'];

    /**
     * Get the full name of the person
     *
     * @return string The full name of the person
     */
    public function getFullnameAttribute(): string
    {
        return $this->firstname.' '.$this->lastname;
    }

    /**
     * Check if the person is a member
     *
     * @return bool True if the person is a member, false otherwise
     */
    public function getIsMemberAttribute(): bool
    {
        return $this->member()->exists();
    }

    /**
     * Get the member associated with this person
     *
     * @return HasOne The member associated with this person
     */
    // phpcs:ignore
    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    /**
     * Get the archived member associated with this person
     *
     * @return HasMany The archived member associated with this person
     */
    // phpcs:ignore
    public function archived_members(): HasMany
    {
        return $this->hasMany(ArchivedMember::class);
    }

    /**
     * Get the sales associated with this person
     *
     * @return HasMany The sales associated with this person
     */
    // phpcs:ignore
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the users associated with this person
     *
     * @return HasMany The users associated with this person
     */
    // phpcs:ignore
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the transactions associated with this person
     *
     * @return HasOne The transactions associated with this person
     */
    // phpcs:ignore
    public function personal_account(): HasOne
    {
        return $this->hasOne(PersonalAccount::class);
    }

    /**
     * Get the events associated with this person
     *
     * @return HasMany The events associated with this person
     */
    // phpcs:ignore
    public function events(): HasMany
    {
        return $this->hasMany(EventPerson::class);
    }
}
