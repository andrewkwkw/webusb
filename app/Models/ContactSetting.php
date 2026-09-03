<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContactSetting extends Model
{
    protected $fillable = [
        'email',
        'instagram',
        'tiktok',
        'youtube',
        'address',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('contact_setting'));
        static::deleted(fn () => Cache::forget('contact_setting'));
    }
}
