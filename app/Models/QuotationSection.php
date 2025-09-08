<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationSection extends Model
{
    protected $guarded = [];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quotation_section_question', 'quotation_section_id', 'question_id');
    }
}
