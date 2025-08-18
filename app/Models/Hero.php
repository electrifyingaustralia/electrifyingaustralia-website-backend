<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'video',
        'video_thumbnail',
        'is_active',
    ];
}
