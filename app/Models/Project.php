<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => 'string',
    ];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class);
    }

    public function getTypeNameAttribute(): string
    {
        return match ($this->type) {
            'commercial'  => 'Commercial',
            'residential' => 'Residential',
            default       => ucfirst($this->type),
        };
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media?->url;
    }
}
