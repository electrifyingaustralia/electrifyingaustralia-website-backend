<?php

namespace App\Http\Requests\Backend;

class ProductTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:product_types,name'
            ],
        ];
    }
}
