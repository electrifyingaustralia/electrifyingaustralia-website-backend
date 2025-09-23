<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    protected $appends = ['logo_url'];

    public function logo()
    {
        return $this->belongsTo(MediaLibrary::class, 'logo_id');
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo?->url;
    }
}
