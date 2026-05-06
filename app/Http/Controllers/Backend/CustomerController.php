<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['category', 'subCategory', 'package', 'quotationForms'])
            ->latest()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->paginate(10);

        return view('backend.customer.index', compact('customers'));
    }

    public function show(Customer $customer,  Request $request)
    {
        if ($customer->status === 'pending') {
            $customer->update([
                'status'     => 'viewed',
                'updated_at' => now(),
            ]);
        }

        $customer->load(['category', 'subCategory', 'answers.question', 'customerServices', 'package.features', 'quotationForms']);
        $editMode = $request->has('edit') && $request->edit === 'true';

        return view('backend.customer.show', compact('customer', 'editMode'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('admin.customer.show', $customer)
            ->with('success', 'Customer information updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();


        return redirect()->route('admin.customer.all')
            ->with('success', 'Customer quotation deleted successfully.');
    }
}
