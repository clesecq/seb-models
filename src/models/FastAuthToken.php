<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a fast auth token in the database
 * Fast auth token is used for scanning QR codes to log in.
 */
class FastAuthToken extends Model
{
    use HasFactory;
    use Prunable;

    protected $primaryKey = 'token';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'token',
        'user_id',
        'accepted',
    ];

    protected $casts = [
        'accepted' => 'boolean',
    ];

    /**
     * Get the prunable model query.
     */
    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subMinutes(5));
    }

    /**
     * Create a new fast auth token
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    /**
     * Get the user associated with this fast auth token
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
