<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'group',
        'label',
        'type',
        'value',
    ];
    const GROUP = [
        'social' => 'social',
        'general' => 'general',
    ];

    public static function clearAllCaches()
    {
        if (Cache::has('settings')) {
            Cache::forget('settings');
        }
        if (Cache::has('all_settings')) {
            Cache::forget('all_settings');
        }
    }

    protected static function booted(): void
    {
        static::created(function () {
            static::clearAllCaches();
        });
        static::updated(function () {
            static::clearAllCaches();
        });
        static::deleted(function () {
            static::clearAllCaches();
        });
        static::saved(function () {
            static::clearAllCaches();
        });
    }
}
