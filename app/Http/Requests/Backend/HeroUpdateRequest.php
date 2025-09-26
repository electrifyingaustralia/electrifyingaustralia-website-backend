<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class HeroUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $heroId = $this->route('hero') ?? $this->route('id');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('heroes', 'title')->ignore($heroId),
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
