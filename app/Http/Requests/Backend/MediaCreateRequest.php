<?php

namespace App\Http\Requests\Backend;

class MediaCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'files' => [
                'required',
                'array'
            ],

            'files.*' => [
                'required',
                'file',
                'max:102400'
            ],

            'metadata' => [
                'nullable',
                'array'
            ]
        ];
    }
}
