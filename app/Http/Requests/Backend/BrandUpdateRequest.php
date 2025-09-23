<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $brandId = $this->route('brand') ?? $this->route('id');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')->ignore($brandId),
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
