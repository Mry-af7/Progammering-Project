<?php

// File: app/Models/SystemSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'category',
        'description',
        'is_public',
        'updated_by',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'value' => 'json',
    ];

    protected $attributes = [
        'type' => 'string',
        'is_public' => false,
    ];

    // Relationships
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Accessors
    public function getFormattedValueAttribute()
    {
        return match($this->type) {
            'boolean' => $this->value ? 'Yes' : 'No',
            'array', 'json' => json_encode($this->value),
            'integer' => number_format($this->value),
            'float' => number_format($this->value, 2),
            default => $this->value
        };
    }

    // Scopes
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    // Static methods
    public static function getValue($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function setValue($key, $value, $type = 'string', $category = 'general')
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'category' => $category,
                'updated_by' => auth()->id(),
            ]
        );
    }
}

