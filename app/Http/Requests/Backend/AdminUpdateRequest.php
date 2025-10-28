<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class AdminUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $adminId = $this->route('admin') ?? $this->route('id');
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
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

        ];
    }
}
