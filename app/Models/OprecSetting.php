<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OprecSetting extends Model
{
    protected $fillable = [
        'is_active',
        'start_date',
        'end_date',
        'brochure_image',
        'title',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
