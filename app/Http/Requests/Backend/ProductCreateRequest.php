<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class ProductCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
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

            'warranty' => [
                'nullable',
                'string',
                'max:255'
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

            'product_type' => [
                'required',
                Rule::in([
                    'solar_panel',
                    'battery',
                    'ev_charger',
                    'inverter'
                ]),
            ],
        ];
    }
}
