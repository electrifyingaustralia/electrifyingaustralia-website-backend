<?php

namespace App\Http\Requests\Backend;

class BrandCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'logo_id' => [
                'required',
                'integer',
                'exists:media_libraries,id'
            ],

            'link' => [
                'nullable',
                'url',
                'max:500',
            ],
        ];
    }
}
