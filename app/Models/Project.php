<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'client_name', 'description', 'thumbnail',
        'demo_url', 'github_url', 'tech_stack', 'category',
        'is_featured', 'is_active', 'completed_at', 'sort_order',
    ];

    protected $casts = [
        'tech_stack'   => 'array',
        'is_featured'  => 'boolean',
        'is_active'    => 'boolean',
        'completed_at' => 'date',
        'sort_order'   => 'integer',
    ];

    public function screenshots(): HasMany
    {
        return $this->hasMany(ProjectScreenshot::class)->orderBy('sort_order');
    }

    public function scopeActive($query)   { return $query->where('is_active', true); }
    public function scopeFeatured($query) { return $query->where('is_featured', true); }
    public function scopeOrdered($query)  { return $query->orderBy('sort_order')->orderBy('created_at'); }
}
