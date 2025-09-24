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

            'type' => [
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
                'required',
                'boolean',
            ],
        ];
    }
}
