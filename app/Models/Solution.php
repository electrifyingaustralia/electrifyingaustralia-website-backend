<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $guarded = [];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class);
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media?->url;
    }
}
