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
                'nullable',
                'email',
                'max:255',
            ],

            'designation' => [
                'required',
                'string',
                'max:50',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
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

            // 'website' => [
            //     'nullable',
            //     'url',
            //     'max:255',
            // ],

            'status' => [
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
