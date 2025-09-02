<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class ProjectCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'required',
                'string',
                'max:255',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'solar_panel' => [
                'nullable',
                'url',
                'max:255',
            ],

            'inverter' => [
                'nullable',
                'url',
                'max:255',
            ],

            'type' => [
                'nullable',
                'string',
                Rule::in(['commercial', 'residential']),
            ],
        ];
    }
}
