<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function movement()
    {
        return $this->belongsTo(Movement::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    protected $fillable = [
        'transaction_id',
        'movement_id',
        'person_id'
    ];
}
