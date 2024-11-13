<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represent a product category in the database
 */
class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the products associated with this category
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
