<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class PackageUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $packageId = $this->route('package') ?? $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages', 'name')->ignore($packageId),
            ],

            'subtitle' => [
                'required',
                'string'
            ],

            'is_best_deal' => [
                'required',
                'boolean'
            ],

            'features' => [
                'required',
                'array',
                'min:1'
            ],

            'features.*' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }
}
