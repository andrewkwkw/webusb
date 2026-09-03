<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CompanyProfile extends Model
{
    protected $fillable = [
        'history',
        'vision_mission',
        'logo_philosophy',
        'organization_structure_image',
        'departments',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('company_profile'));
        static::deleted(fn () => Cache::forget('company_profile'));
    }
}
