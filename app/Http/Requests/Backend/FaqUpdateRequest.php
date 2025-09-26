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
            'type' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    'General',
                    'Solar & Battery',
                    'EV Charger',
                    'VPP & Energy Solutions',
                    'Installation & Support',
                ]),
            ],
            'is_active' => [
                'sometimes',
                'required',
                'boolean',
            ],
        ];
    }
}
