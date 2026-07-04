<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingPlan extends Model
{
    protected $fillable = [
        'name', 'slug', 'tagline', 'price', 'billing_cycle',
        'is_featured', 'is_active', 'badge_text', 'cta_text', 'cta_url', 'sort_order',
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(PricingFeature::class)->orderBy('sort_order');
    }

    public function scopeActive($query)   { return $query->where('is_active', true); }
    public function scopeOrdered($query)  { return $query->orderBy('sort_order')->orderBy('created_at'); }
}
