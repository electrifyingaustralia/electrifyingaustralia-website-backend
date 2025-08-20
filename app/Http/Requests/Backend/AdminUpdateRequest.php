<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class AdminUpdateRequest extends BaseRequest
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
                Rule::unique('admins')->ignore($this->route('id')),
            ],
            'password' => [
                'nullable',
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
