<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represent a movement in the database
 */
class Movement extends Model
{
    use HasFactory;


    /**
     *
     * @return HasMany
     */
    public function products() : HasMany
    {
        return $this->hasMany(ProductMovement::class);
    }

    protected $fillable = [
        'name',
        'rectification',
        'user_id'
    ];

    protected $casts = [
        'rectification' => 'boolean'
    ];
}
