<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent an archived member in the database
 */
class ArchivedMember extends Model
{
    use HasFactory;

    protected $casts = [
        'paid' => 'boolean',
    ];

    protected $fillable = [
        'person_id',
        'transaction_id',
        'created_at',
        'updated_at',
        'year',
    ];

    protected $appends = ['paid', 'school_year'];

    /**
     * Check if this member has paid
     */
    public function getPaidAttribute(): bool
    {
        return $this->transaction_id != null;
    }

    /**
     * Get the string of school year for this archived member
     */
    public function getSchoolYearAttribute(): string
    {
        return ($this->year - 1).'/'.($this->year);
    }

    /**
     * Get the transaction associated with this archived member
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the person associated with this archived member
     */
    // phpcs:ignore
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
