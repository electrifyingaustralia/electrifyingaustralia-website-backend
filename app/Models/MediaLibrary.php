<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaLibrary extends Model
{
    protected $guarded = [];

    protected $appends = ['url', 'is_image', 'is_video'];

    public function getUrlAttribute(): string
    {
        $disk = $this->disk ?? 'public';

        if ($disk === 'local') {
            return asset('storage/' . $this->file_path);
        }

        return Storage::disk($disk)->url($this->file_path);
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
