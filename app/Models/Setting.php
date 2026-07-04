<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    /**
     * Bust the settings cache on saved/deleted events.
     */
    protected static function booted()
    {
        static::saved(function () {
            cache()->forget('site_settings');
        });

        static::deleted(function () {
            cache()->forget('site_settings');
        });
    }

    /**
     * Get a setting value by key, using cache.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = static::allKeyed();
        return array_key_exists($key, $settings) ? $settings[$key] : $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, mixed $value): static
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Get all settings as key => value array, loaded from cache.
     */
    public static function allKeyed(): array
    {
        return cache()->rememberForever('site_settings', function () {
            return static::pluck('value', 'key')->toArray();
        });
    }
}
