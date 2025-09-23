<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts =
    [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class, 'media_id');
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media?->url;
    }
}
