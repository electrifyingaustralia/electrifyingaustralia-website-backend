<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerQuotationForm extends Model
{
    protected $guarded = [];

    protected $casts = [
        'interests' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getInterestsListAttribute()
    {
        return implode(', ', $this->interests ?? []);
    }
}
