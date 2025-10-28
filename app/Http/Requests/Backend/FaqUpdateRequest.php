<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FaqUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $faqId = $this->route('faq') ?? $this->route('id');

        return [
            'question' => [
                'required',
                'string',
                'max:255',
                Rule::unique('faqs', 'question')->ignore($faqId),
            ],
            'answer' => [
                'sometimes',
                'required',
                'string',
            ],
            'faq_type_id' => [
                'required',
                'exists:faq_types,id'
            ],
            'is_active' => [
                'sometimes',
                'required',
                'boolean',
            ],
        ];
    }
}
