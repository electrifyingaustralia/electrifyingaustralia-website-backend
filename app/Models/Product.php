<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class, 'media_id');
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media?->url;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
