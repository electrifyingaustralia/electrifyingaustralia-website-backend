<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class BrandCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'logo_id' => [
                'required',
                'integer',
                'exists:media_libraries,id'
            ],

            'link' => [
                'required',
                'url',
                'max:500',
            ],
        ];
    }
}
