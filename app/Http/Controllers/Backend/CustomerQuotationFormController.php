<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerQuotationFormCreateRequest;
use App\Jobs\SendNewCustomerQuotationEmailJob;
use App\Models\Customer;
use App\Models\CustomerQuotationForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerQuotationFormController extends Controller
{
    public function store(CustomerQuotationFormCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::create([
                'first_name' => $request->full_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'message'    => $request->message ?? null,
                'type'       => 'quotation',
            ]);

            $data = CustomerQuotationForm::create([
                'customer_id' => $customer->id,

                'interests'     => $request->interests ?? null,
                'proposal_type' => $request->proposal_type ?? null,

                'solar_existing_system' => $request->solar_existing_system ?? null,
                'solar_existing_age'    => $request->solar_existing_age ?? null,
                'solar_system_size'     => $request->solar_system_size ?? null,
                'solar_roof_type'       => $request->solar_roof_type ?? null,
                'solar_existing_size'   => $request->solar_existing_size ?? null,

                'battery_capacity'     => $request->battery_capacity ?? null,
                'battery_upgrade_type' => $request->battery_upgrade_type ?? null,
                'battery_existing'     => $request->battery_existing ?? null,
                'battery_existing_age' => $request->battery_existing_age ?? null,

                'ev_charger_existing'         => $request->ev_charger_existing ?? null,
                'ev_charger_type'             => $request->ev_charger_type ?? null,
                'ev_charger_install_location' => $request->ev_charger_install_location ?? null,
                'ev_charger_upgrade_type'     => $request->ev_charger_upgrade_type ?? null,

                'phase_type'             => $request->phase_type ?? null,
                'switchboard_distance'   => $request->switchboard_distance ?? null,
                'bill_amount'            => $request->bill_amount ?? null,
                'bill_period'            => $request->bill_period ?? null,
                'property_type'          => $request->property_type ?? null,
                'installation_timeframe' => $request->installation_timeframe ?? null,
            ]);

            DB::commit();

            SendNewCustomerQuotationEmailJob::dispatch($customer, $data);

            return response()->json([
                'success' => true,
                'message' => 'We have received your quotation request. Our team will review the details and get back to you shortly.',

                'customer' => [
                    'full_name' => $customer->first_name,
                    'email'     => $customer->email,
                    'phone'     => $customer->phone,
                    'address'   => $customer->address,
                    'message'   => $customer->message,
                ],

                'quotation' => [
                    'interests'     => $data->interests,
                    'proposal_type' => $data->proposal_type,
                    // Solar fields
                    'solar_existing_system' => $data->solar_existing_system,
                    'solar_existing_age'    => $data->solar_existing_age,
                    'solar_system_size'     => $data->solar_system_size,
                    'solar_roof_type'       => $data->solar_roof_type,
                    'solar_existing_size'   => $data->solar_existing_size,
                    // Battery fields
                    'battery_capacity'     => $data->battery_capacity,
                    'battery_upgrade_type' => $data->battery_upgrade_type,
                    'battery_existing'     => $data->battery_existing,
                    'battery_existing_age' => $data->battery_existing_age,
                    // EV Charger fields
                    'ev_charger_existing'         => $data->ev_charger_existing,
                    'ev_charger_type'             => $data->ev_charger_type,
                    'ev_charger_install_location' => $data->ev_charger_install_location,
                    'ev_charger_upgrade_type'     => $data->ev_charger_upgrade_type,
                    // Common fields
                    'phase_type'             => $data->phase_type,
                    'switchboard_distance'   => $data->switchboard_distance,
                    'bill_amount'            => $data->bill_amount,
                    'bill_period'            => $data->bill_period,
                    'property_type'          => $data->property_type,
                    'installation_timeframe' => $data->installation_timeframe,

                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotation submission failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to submit quotation. Please try again later.'], 500);
        }
    }
}
