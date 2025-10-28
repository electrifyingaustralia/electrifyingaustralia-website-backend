<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuotationValidationRequest;
use App\Jobs\SendQuotationNotificationJob;
use App\Models\Customer;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    public function store(QuotationValidationRequest $request)
    {
        $data = $request->validated();

        $data["type"] = isset($data["first_name"]) ? "contact" : "subscribe";

        $customer = Customer::create($data);

        SendQuotationNotificationJob::dispatch($customer);

        return response()->json([
            "message" => "Thank you for sharing your information with us."
        ]);
    }
}
