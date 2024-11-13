<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represent a product category in the database
 */
class TransactionCategory extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * Get the transactions associated with this category
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'category_id');
    }

    use HasFactory;
}
