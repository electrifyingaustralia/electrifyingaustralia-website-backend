<?php

namespace App\Http\Requests\Backend;

class QuotationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'subtitle' => [
                'nullable',
                'unique:quotation_sections,subtitle',
                'string',
                'max:500'
            ]
        ];
    }
}
