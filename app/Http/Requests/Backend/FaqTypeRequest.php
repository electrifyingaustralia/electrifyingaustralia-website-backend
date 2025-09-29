<?php

namespace App\Http\Requests\Backend;

class FaqTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:faq_types,name'
            ],
        ];
    }
}
