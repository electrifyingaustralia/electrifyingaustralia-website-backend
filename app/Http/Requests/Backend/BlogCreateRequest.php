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

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
            ],

            'description' => [
                'required',
                'string',
            ],

            'short_description' => [
                'required',
                'string',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'blog_category_id' => [
                'required',
                'exists:blog_categories,id',
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
