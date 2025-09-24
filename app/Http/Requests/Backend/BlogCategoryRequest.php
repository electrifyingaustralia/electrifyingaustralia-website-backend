<?php

namespace App\Http\Requests\Backend;

class BlogCategoryRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:blog_categories,name'
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255'
            ]
        ];
    }
}
