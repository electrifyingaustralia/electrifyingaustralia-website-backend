<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class FaqUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $faqId = $this->route('faq') ?? $this->route('id');

        return [
            'question' => [
                'required',
                'string',
                'max:255',
                Rule::unique('events', 'title')->ignore($faqId),
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
