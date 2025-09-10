<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\QuotationRequest;
use App\Services\Quotation\QuotationServiceInterface;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function __construct(protected QuotationServiceInterface $quotationService) {}

    public function index()
    {
        $quotations = $this->quotationService->get();
        return view('backend.quotation.sections.quotation-section', compact('quotations'));
    }

    public function store(QuotationRequest $request)
    {
        $data = $request->validated();
        $this->quotationService->createQuotation($data);
        return redirect()->route('admin.quotation.all')->with('success', 'Quotation created successfully!');
    }

    public function edit($id)
    {
        $quotationToEdit = $this->quotationService->findQuotation($id);
        $quotations = $this->quotationService->get();
        return view('backend.quotation.sections.quotation-section', compact('quotationToEdit', 'quotations'));
    }

    public function update(QuotationRequest $request, $id)
    {
        $data = $request->validated();

        $this->quotationService->updateQuotation($id, $data);
        return redirect()->route('admin.quotation.all')->with('success', 'Quotation updated successfully!');
    }

    public function destroy($id)
    {
        $this->quotationService->deleteQuotation($id);
        return redirect()->route('admin.quotation.all')->with('success', 'Quotation deleted successfully');
    }
}
