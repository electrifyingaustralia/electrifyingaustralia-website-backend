<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerServiceValidationRequest;
use App\Jobs\SendServiceNotificationJob;
use App\Models\Customer;
use App\Models\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class ApiCustomerServiceController extends Controller
{
    public function store(CustomerServiceValidationRequest $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::create(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    // 'address' => $request->address,
                    'type' => 'service',
                    'status' => 'pending'
                ]
            );

            $serviceData = [
                'customer_id' => $customer->id,
                'product_type' => $request->product_type,
                'issue_type' => $request->issue_type,
                'issue_details' => $request->issue_details,
                'service_number' => $this->generateServiceNumber(),
            ];

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');

                if ($file->isValid()) {
                    $diskType = env("FILESYSTEM_DISK", "public");
                    $randomName = $file->store('service', $diskType);

                    $serviceData['attachment'] = json_encode([
                        'original_name' => $file->getClientOriginalName(),
                        'random_name'  => basename($randomName),
                        'extension'    => $file->getClientOriginalExtension(),
                        'path'         => $randomName,
                    ]);
                }
            }

            $customerService = CustomerService::create($serviceData);

            DB::commit();

            SendServiceNotificationJob::dispatch($customerService);

            return response()->json([
                "message" => "Your service request submitted successfully!",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to save service request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate unique service number
     */
    private function generateServiceNumber(): string
    {
        do
            $serviceNumber = 'SN-' . strtoupper(Str::random(8));
        while (CustomerService::where('service_number', $serviceNumber)->exists());

        return $serviceNumber;
    }
}
