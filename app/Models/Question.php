<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $hidden = ["pivot"];

    public function quotationSections()
    {
        return $this->belongsToMany(QuotationSection::class, 'quotation_section_question', 'question_id', 'quotation_section_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
