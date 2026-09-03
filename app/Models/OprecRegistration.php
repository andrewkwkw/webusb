<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprecRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'division',
        'motivation',
        'portfolio_link',
        // 'status' intentionally excluded — only admin can change via Filament
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
