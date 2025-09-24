<?php

namespace App\Http\Requests\Backend;

class EventCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:events,title'
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

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
