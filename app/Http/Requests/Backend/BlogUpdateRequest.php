<?php

namespace App\Http\Requests\Backend;

class BlogUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
            ],

            'short_description' => [
                'required',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'media_id' => [
                'required',
                'exists:media_libraries,id',
            ],

            'blog_category_id' => [
                'required',
                'exists:blog_categories,id',
            ],

            'reading_time' => [
                'nullable',
                'string'
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

            'meta_title' => [
                'nullable',
                'string'
            ],

            'meta_description' => [
                'nullable',
                'string'
            ],

            'keywords' => [
                'nullable',
                'string'
            ],
        ];
    }
}
