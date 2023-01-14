<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a participant in the database
 */
class EventPerson extends Model
{
    protected $fillable = [
        'event_id',
        'person_id',
        'transaction_id',
        'data'
    ];

    protected $casts = [
        'data' => 'object'
    ];

    /**
     * Get the event associated with this participant
     *
     * @return BelongsTo
     */
    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the person associated with this participant
     *
     * @return BelongsTo
     */
    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the transaction associated with this participant
     *
     * @return BelongsTo
     */
    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

}
