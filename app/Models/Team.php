<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    protected $appends = 'avatar_url';

    public function getAvatarUrlAttribute()
    {
        if (!isset($this->attributes["avatar"])) return null;

        return getAssetFileUrl("teams", $this->attributes['avatar']);
    }
}
