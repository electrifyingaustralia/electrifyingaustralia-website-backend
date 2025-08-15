<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    protected $appends = 'logo_url';

    public function getLogoUrlAttribute()
    {
        if (!isset($this->attributes['logo'])) return null;

        return getAssetFileUrl("brands", $this->attributes['logo']);
    }
}
