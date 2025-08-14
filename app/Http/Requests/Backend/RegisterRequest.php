<?php

namespace App\Http\Requests\Backend;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'string',
                'max:255',
                'unique:admins'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ]
        ];
    }
}
