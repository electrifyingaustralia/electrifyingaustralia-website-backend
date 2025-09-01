<?php

namespace App\Http\Requests\Backend;

class BlogCreateRequest extends BaseRequest
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

            'facebook_link' => [
                'nullable',
                'url',
                'max:255',
            ],

            'twitter_link' => [
                'nullable',
                'url',
                'max:255',
            ],

            'linkedin_link' => [
                'nullable',
                'url',
                'max:255',
            ],

            'youtube_link' => [
                'nullable',
                'url',
                'max:255',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
