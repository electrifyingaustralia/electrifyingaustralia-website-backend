<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class BenefitUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $benefitId = $this->route('benefit') ?? $this->route('id');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('benefits', 'title')->ignore($benefitId),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255'
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'bold_info' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
