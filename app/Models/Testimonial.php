<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_name', 'client_designation', 'client_company', 'client_avatar',
        'review', 'rating', 'is_active', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'rating'      => 'integer',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function scopeActive($query)   { return $query->where('is_active', true); }
    public function scopeFeatured($query) { return $query->where('is_featured', true); }
    public function scopeOrdered($query)  { return $query->orderBy('sort_order')->orderBy('created_at'); }
}
