<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $eventId = $this->route('event') ?? $this->route('id');
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('events', 'title')->ignore($eventId),
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'media_id' => [
                'nullable',
                'exists:media_libraries,id',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
