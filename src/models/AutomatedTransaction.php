<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represent an automated transaction in the database
 */
class AutomatedTransaction extends Model
{
    use HasFactory;

    protected $casts = [
        'rectification' => 'boolean',
        'amount' => 'double'
    ];

    protected $fillable = [
        'name',
        'amount',
        'rectification',
        'user_id',
        'account_id',
        'category_id',
        'frequency',
        'day'
    ];
}
