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
                'string',
                'max:500'
            ]
        ];
    }
}
