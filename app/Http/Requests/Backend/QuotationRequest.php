<?php

namespace App\Http\Requests\Backend;

class QuotationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'category' => [
                'required',
                'string',
                'max:255'
            ],

            'subcategory' => [
                'nullable',
                'array',
            ]
        ];
    }
}
