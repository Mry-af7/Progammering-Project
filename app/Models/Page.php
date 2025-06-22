<?php
// File: app/Models/Page.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'show_in_nav',
        'nav_order',
        'template',
        'featured_image',
        'created_by',
        'updated_by',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_in_nav' => 'boolean',
        'nav_order' => 'integer',
        'published_at' => 'datetime',
    ];

    protected $attributes = [
        'is_published' => true,
        'show_in_nav' => false,
        'nav_order' => 0,
        'template' => 'default',
    ];

    // Relationships
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Accessors
    public function getUrlAttribute(): string
    {
        return route('pages.show', $this->slug);
    }

    public function getExcerptAttribute(): string
    {
        if ($this->attributes['excerpt']) {
            return $this->attributes['excerpt'];
        }

        return Str::limit(strip_tags($this->content), 160);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeInNavigation($query)
    {
        return $query->where('show_in_nav', true)
                    ->orderBy('nav_order');
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            if (!$page->slug) {
                $page->slug = Str::slug($page->title);
            }
            if (!$page->published_at && $page->is_published) {
                $page->published_at = now();
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('is_published') && $page->is_published && !$page->published_at) {
                $page->published_at = now();
            }
        });
    }
}
