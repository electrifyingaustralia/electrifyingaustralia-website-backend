<?php

namespace App\Http\Requests\Backend;

class ProductTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        $productTypeId = $this->route('product_type') ? $this->route('product_type')->id
            : ($this->route('id') ?? null);

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:product_types,name' . ($productTypeId ? ',' . $productTypeId : '')
            ],

            'meta_title' => [
                'nullable',
                'string'
            ],

            'meta_description' => [
                'nullable',
                'string'
            ],

            'keywords' => [
                'nullable',
                'string'
            ],
        ];
    }
}
