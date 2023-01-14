<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * Represent a user in the database
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'person_id',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array'
    ];

    /**
     * Check if the user has a specific permission
     * @param string $name The name of the permission
     * @return bool
     */
    public function hasPermission(string $name): bool
    {
        $split = explode('.', $name);
        $resource = $split[0];
        $action = $split[1];

        return in_array('*.*', $this->permissions) ||
               in_array($resource . '.*', $this->permissions) ||
               in_array('*.' . $action, $this->permissions) ||
               in_array($name, $this->permissions);
    }

    /**
     * Return the person associated with this user
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
