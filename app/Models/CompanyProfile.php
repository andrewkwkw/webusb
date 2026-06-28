<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'history',
        'vision_mission',
        'logo_philosophy',
        'organization_structure_image',
        'departments',
    ];
}
