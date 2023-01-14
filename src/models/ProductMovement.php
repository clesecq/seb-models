<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Represent a product movement in the database
 */
class ProductMovement extends Pivot
{
    use HasFactory;

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted() : void
    {
        static::created(function ($movement) {
            $movement->product->recalculate();
        });
    }

    public $timestamps = false;

    protected $fillable = [
        "product_id",
        "movement_id",
        "count"
    ];


    /**
     * Get the product associated with this movement
     *
     * @return HasOne
     */
    public function product() : HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
