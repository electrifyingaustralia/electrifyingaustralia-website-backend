<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class FaqCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
