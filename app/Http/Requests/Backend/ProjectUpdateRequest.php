<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class ProjectUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'category' => [
                'sometimes',
                Rule::in(['commercial', 'residential']),
            ],

            'type' => [
                'sometimes',
                Rule::in(['solar', 'batteries', 'ev_charger', 'heat_pump']),
            ],

            'location' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'media_id' => [
                'sometimes',
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
