<?php

namespace App\Http\Requests\Backend;

class TeamCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'designation' => [
                'nullable',
                'string',
                'max:50',
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
            ],
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'website' => [
                'nullable',
                'url',
                'max:255',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
            'twitter_link' => [
                'nullable',
                'string',
                'max:255',
                'url'
            ],
            'instagram_link' => [
                'nullable',
                'string',
                'max:255',
                'url'
            ],
            'facebook_link' => [
                'nullable',
                'string',
                'max:255',
                'url'
            ],
            'pinterest_link' => [
                'nullable',
                'string',
                'max:255',
                'url'
            ],
            'youtube_link' => [
                'nullable',
                'string',
                'max:255',
                'url'
            ],
        ];
    }
}
