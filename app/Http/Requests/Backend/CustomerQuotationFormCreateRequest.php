<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerQuotationFormCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            'phone' => [
                'required',
                'string',
                'max:20'
            ],
            'address' => [
                'required',
                'string',
                'max:500'
            ],
            'message' => [
                'nullable',
                'string'
            ],

            'interests' => [
                'nullable',
                'array'
            ],
            'interests.*' => [
                'string'
            ],
            'proposal_type' => [
                'nullable',
                'string'
            ],

            'solar_existing_system' => [
                'nullable',
                'string'
            ],
            'solar_existing_age' => [
                'nullable',
                'string'
            ],
            'solar_system_size' => [
                'nullable',
                'string'
            ],
            'solar_roof_type' => [
                'nullable',
                'string'
            ],
            'solar_existing_size' => [
                'nullable',
                'string'
            ],

            'battery_capacity' => [
                'nullable',
                'string'
            ],
            'battery_upgrade_type' => [
                'nullable',
                'string'
            ],
            'battery_existing' => [
                'nullable',
                'string'
            ],
            'battery_existing_age' => [
                'nullable',
                'string'
            ],

            'ev_charger_existing' => [
                'nullable',
                'string'
            ],
            'ev_charger_type' => [
                'nullable',
                'string'
            ],
            'ev_charger_install_location' => [
                'nullable',
                'string'
            ],
            'ev_charger_upgrade_type' => [
                'nullable',
                'string'
            ],

            'phase_type' => [
                'nullable',
                'string'
            ],
            'switchboard_distance' => [
                'nullable',
                'string'
            ],
            'bill_amount' => [
                'nullable',
                'string'
            ],
            'bill_period' => [
                'nullable',
                'string'
            ],
            'property_type' => [
                'required',
                'string'
            ],
            'installation_timeframe' => [
                'nullable',
                'string'
            ],
        ];
    }
}
