<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Project extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'category',
        'video_embed_url',
        'cover_image_path',
        'user_id',
        'is_published',
        'is_coming_soon',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_coming_soon' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (empty($this->video_embed_url)) {
            return null;
        }

        $url = trim($this->video_embed_url);

        if (preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube-nocookie.com/embed/' . $matches[1] . '?rel=0&modestbranding=1';
        }

        return $url;
    }
}
