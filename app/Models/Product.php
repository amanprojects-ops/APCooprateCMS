<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'tagline', 'short_description', 'description',
        'thumbnail', 'demo_url', 'docs_url', 'github_url', 'category',
        'tech_stack', 'is_active', 'is_featured', 'sort_order',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'tech_stack'  => 'array',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function screenshots(): HasMany
    {
        return $this->hasMany(ProductScreenshot::class)->orderBy('sort_order');
    }

    public function scopeActive($query)     { return $query->where('is_active', true); }
    public function scopeFeatured($query)   { return $query->where('is_featured', true); }
    public function scopeOrdered($query)    { return $query->orderBy('sort_order')->orderBy('created_at'); }
}
