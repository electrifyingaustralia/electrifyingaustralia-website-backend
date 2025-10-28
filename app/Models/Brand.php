<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public function logo()
    {
        return $this->belongsTo(MediaLibrary::class, 'logo_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
