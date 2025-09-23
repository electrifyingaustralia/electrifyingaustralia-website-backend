<?php

namespace App\Http\Requests\Backend;

class PackageCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'subtitle' => [
                'required',
                'string'
            ],

            'is_best_deal' => [
                'required',
                'boolean'
            ],

            'features' => [
                'required',
                'array',
                'min:1'
            ],

            'features.*' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }
}
