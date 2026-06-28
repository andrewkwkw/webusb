<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class CulturalExploration extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'slug', 'content', 'image_path', 'category', 'location', 'tags', 'user_id', 'is_published'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    protected $attributes = [
        'is_published' => false,
    ];
    
    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
    ];
}
