<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventPerson extends Pivot
{
    protected $fillable = [
        'event_id',
        'person_id',
        'transaction_id',
        'data'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
