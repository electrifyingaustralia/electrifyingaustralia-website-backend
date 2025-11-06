<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class ProductUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $productId = $this->route('product') ?? $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($productId),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'model_number' => [
                'required',
                'string',
                'max:255'
            ],

            'short_description' => [
                'nullable',
                'string'
            ],

            'brand_id' => [
                'nullable',
                'exists:brands,id'
            ],

            'product_type_id' => [
                'required',
                'exists:product_types,id',
            ],

            'is_featured' => ['boolean'],

            'is_active' => ['boolean'],

            'product_link' => [
                'nullable',
                'url'
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id'
            ],

            'attributes' => [
                'nullable',
                'array'
            ],

            'attributes.*.key' => [
                'required',
                'string',
                'max:255'
            ],

            'attributes.*.value' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }
}
