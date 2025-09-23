<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class FaqUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'question' => [
                'sometimes',
                'required',
                'string',
                'max:255',
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
