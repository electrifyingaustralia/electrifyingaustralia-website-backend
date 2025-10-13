<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationSection extends Model
{
    protected $guarded = [];

    public function parentCat()
    {
        return $this->belongsTo(self::class, 'parent_id', "id");
    }

    public function subCats()
    {
        return $this->hasMany(self::class, 'parent_id', "id")->orderBy("id", 'ASC');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quotation_section_question', 'quotation_section_id', 'question_id')
            ->withPivot('order')
            ->orderBy('quotation_section_question.order');
    }
}
