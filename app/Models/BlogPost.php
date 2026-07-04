<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'thumbnail', 'category',
        'tags', 'is_published', 'is_featured', 'views', 'published_at',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'tags'         => 'array',
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
        'views'        => 'integer',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)  { return $query->where('is_published', true); }
    public function scopeFeatured($query)   { return $query->where('is_featured', true); }
    public function scopeLatest2($query)    { return $query->orderByDesc('published_at'); }
}
