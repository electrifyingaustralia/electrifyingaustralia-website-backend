<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class, 'media_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media?->url;
    }
}
