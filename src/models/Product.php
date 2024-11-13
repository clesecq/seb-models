<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represent a product in the database
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'alert_level',
        'salable',
    ];

    protected $casts = [
        'price' => 'double',
        'salable' => 'boolean',
    ];

    /**
     * Get the category associated with this product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Get the transactions associated with this product
     */
    public function movements(): HasMany
    {
        return $this->hasMany(ProductMovement::class);
    }

    /**
     * Recalculate the stock of this product
     */
    public function recalculate(): void
    {
        $this->count = $this->movements->sum('count');
        $this->save();
    }

    /**
     * Recalculate the stock of all products
     */
    public static function recalculateAll(): void
    {
        foreach (static::all() as $product) {
            $product->recalculate();
        }
    }
}
