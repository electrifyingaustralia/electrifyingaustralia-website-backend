<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    protected $guarded = [];

    protected $appends = ['url', 'is_image', 'is_video'];

    public function getUrlAttribute(): string|null
    {
        return getAssetFileUrl("media", $this->file_name, disk: $this->disk);
    }

    public function getIsImageAttribute(): bool
    {
        return $this->file_type === 'image';
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->file_type === 'video';
    }
}
