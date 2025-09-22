<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class, 'media_id');
    }

    public function images()
    {
        return $this->belongsToMany(MediaLibrary::class, 'event_images', 'event_id', 'media_id')
            ->withTimestamps();
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media?->url;
    }

    public function getImageUrlsAttribute(): array
    {
        return $this->images->map(function ($image) {
            return $image->url;
        })->toArray();
    }
}
