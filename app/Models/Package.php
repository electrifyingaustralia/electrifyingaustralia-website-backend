<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
