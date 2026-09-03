<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class ArtNews extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
        'category',
        'event_date',
        'is_highlight',
        'user_id',
        'is_published',
    ];

    protected $attributes = [
        'is_published' => false,
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_highlight' => 'boolean',
        'is_published' => 'boolean',
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
}
