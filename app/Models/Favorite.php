<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'favoritable_id',
        'favoritable_type'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function favoritable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();

        // Automatisch verwijderen van favorieten als het gekoppelde item wordt verwijderd
        static::deleting(function ($favorite) {
            // Optioneel: log de verwijdering
            \Log::info('Favorite deleted', [
                'id' => $favorite->id,
                'user_id' => $favorite->user_id,
                'favoritable_type' => $favorite->favoritable_type,
                'favoritable_id' => $favorite->favoritable_id
            ]);
        });
    }
} 