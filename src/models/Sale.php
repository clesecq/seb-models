<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a sale in the database
 */
class Sale extends Model
{
    use HasFactory;

    /**
     * Get the movement associated with this sale
     */
    public function movement(): BelongsTo
    {
        return $this->belongsTo(Movement::class);
    }

    /**
     * Get the transaction associated with this sale
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    protected $fillable = [
        'transaction_id',
        'movement_id',
        'person_id',
    ];
}
