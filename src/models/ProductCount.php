<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a product count in the database
 */
class ProductCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'movement_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    /**
     * Get the movement associated with this count
     *
     * @return BelongsTo
     */
    public function movement() : BelongsTo
    {
        return $this->belongsTo(Movement::class);
    }
}
