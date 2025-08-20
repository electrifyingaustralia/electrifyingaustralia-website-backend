<?php

namespace App\Http\Requests\Backend;

class AdminCreateRequest extends BaseRequest
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
                'unique:users',
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg',
                'max:10240'
            ],
        ];
    }
}
