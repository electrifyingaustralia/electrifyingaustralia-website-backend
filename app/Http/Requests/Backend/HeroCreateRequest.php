<?php

namespace App\Http\Requests\Backend;

class HeroCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:heroes,title'
            ],

            'subtitle' => [
                'nullable',
                'string'
            ],

            'video_url' => [
                'nullable',
                'url'
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id'
            ],

            'is_active' => [
                'boolean'
            ],
        ];
    }
}
