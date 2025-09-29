<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class FaqCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'question' => [
                'required',
                'string',
                'max:255',
                'unique:faqs,question',
            ],

            'answer' => [
                'required',
                'string',
            ],

            'faq_type_id' => [
                'required',
                'exists:faq_types,id'
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
