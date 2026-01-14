<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuotationValidationRequest;
use App\Jobs\SendQuotationNotificationJob;
use App\Models\Customer;
use App\Models\Package;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    public function store(QuotationValidationRequest $request)
    {
        $data = $request->validated();

        // $data["type"] = isset($data["first_name"]) ? "contact" : "subscribe";
        if (isset($data["package_id"])) {
            $data["type"] = "package";
        } elseif (isset($data["first_name"])) {
            $data["type"] = "contact";
        } else {
            $data["type"] = "subscribe";
        }

        if (isset($data["package_id"])) {
            $packageExists = Package::where('id', $data["package_id"])->exists();

            if (!$packageExists) {
                return response()->json([
                    "message" => "Invalid package selected."
                ], 422);
            }
        }

        $customer = Customer::create($data);
        $customer->load(['package.features']);

        SendQuotationNotificationJob::dispatch($customer);

        return response()->json([
            "message" => "Thank you for sharing your information with us."
        ]);
    }
}
