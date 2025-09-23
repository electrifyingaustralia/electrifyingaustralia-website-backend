<?php

namespace App\Http\Requests\Backend;

class BenefitCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'bold_info' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
