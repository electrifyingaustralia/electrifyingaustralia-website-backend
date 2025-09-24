<?php

namespace App\Http\Requests\Backend;

class ProjectCategoryRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:project_categories,name'
            ],
        ];
    }
}
