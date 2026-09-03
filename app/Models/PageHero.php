<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHero extends Model
{
    protected $fillable = [
        'page_name',
        'image_path',
        'image_path_2',
    ];
}
