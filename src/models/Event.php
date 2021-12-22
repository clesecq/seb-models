<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'inscriptions_closed_at' => 'datetime',
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'location',
        'inscriptions_closed_at',
        'start',
        'end',
        'max_people',
        'price',
        'price_member',
        'data',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    // phpcs:ignore
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'event_person', 'event_id', 'person_id')
            ->using(EventPerson::class)->withTimestamps();
    }
}
