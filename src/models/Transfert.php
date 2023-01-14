<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a transfert in the database
 */
class Transfert extends Model
{
    use HasFactory;

    /**
     * Get the sub transaction associated with this transfert
     *
     * @return BelongsTo
     */
    // phpcs:ignore
    public function sub_transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'sub_transaction_id');
    }

    /**
     * Get the add transaction associated with this transfert
     *
     * @return BelongsTo
     */
    // phpcs:ignore
    public function add_transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'add_transaction_id');
    }
}
