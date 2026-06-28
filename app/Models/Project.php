<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Project extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'slug', 'description', 'content', 'category', 'video_embed_url', 'cover_image_path', 'user_id', 'is_published'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
