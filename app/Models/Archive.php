<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Archive extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'activity_type',
        'year',
        'document_path',
        'user_id',
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
}
