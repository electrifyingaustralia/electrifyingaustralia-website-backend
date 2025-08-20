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

            'logo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
                'max:10240',
            ],

            'link' => [
                'nullable',
                'url',
                'max:255',
            ],
        ];
    }
}
