<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqType extends Model
{
    protected $guarded = [];

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'faq_type_id');
    }
}
