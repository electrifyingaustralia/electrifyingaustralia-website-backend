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

            'description' => [
                'nullable',
                'string',
            ],

            'category' => [
                'required',
                Rule::in(['commercial', 'residential']),
            ],

            'type' => [
                'required',
                Rule::in(['solar', 'batteries', 'ev_charger', 'heat_pump']),
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'extra_info_1' => [
                'nullable',
                'string',
            ],

            'extra_info_2' => [
                'nullable',
                'string',
            ],

            'extra_info_3' => [
                'nullable',
                'string',
            ],

            'extra_info_4' => [
                'nullable',
                'string',
            ],

            'extra_info_5' => [
                'nullable',
                'string',
            ],
        ];
    }
}
