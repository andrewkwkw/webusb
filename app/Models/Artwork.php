<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Artwork extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'slug', 'description', 'category', 'images', 'video_url', 'publication_year', 'creator_name', 'is_featured', 'is_published', 'user_id'];
    
    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
