<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'discord_id'
    ];

    protected $hidden = [
        'edu_token'
    ];

    protected $appends = ['fullname', 'is_member'];

    public function getFullnameAttribute()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function getIsMemberAttribute() {
        return $this->member()->exists();
    }

    // phpcs:ignore
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    // phpcs:ignore
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // phpcs:ignore
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // phpcs:ignore
    public function personal_account()
    {
        return $this->hasOne(PersonalAccount::class);
    }

    // phpcs:ignore
    public function events()
    {
        return $this->hasMany(EventPerson::class);
    }
}
