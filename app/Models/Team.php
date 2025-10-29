<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class, 'media_id');
    }
}
