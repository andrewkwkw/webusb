<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Archive extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'description', 'activity_type', 'year', 'document_path', 'user_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
