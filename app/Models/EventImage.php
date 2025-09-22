<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{

    protected $table = 'event_images';

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class);
    }
}
