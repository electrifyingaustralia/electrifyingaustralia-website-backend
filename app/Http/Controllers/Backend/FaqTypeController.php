<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\FaqTypeRequest;
use App\Services\FaqType\FaqTypeServiceInterface;
use Illuminate\Http\Request;

class FaqTypeController extends Controller
{
    public function __construct(protected FaqTypeServiceInterface $faqTypeService) {}

    public function index()
    {
        $types = $this->faqTypeService->get();
        return view('Backend.faq-type.index', compact('types'));
    }

    public function store(FaqTypeRequest $request)
    {
        $this->faqTypeService->createFaqType($request->all());
        return redirect()->route('admin.faq-type.all')->with('success', 'Faq type created successfully!');
    }

    public function edit($id)
    {
        $typeToEdit = $this->faqTypeService->findFaqType($id);
        $types = $this->faqTypeService->get();
        return view('Backend.faq-type.index', compact('typeToEdit', 'types'));
    }

    public function update(FaqTypeRequest $request, $id)
    {
        $this->faqTypeService->updateFaqType($id, $request->all());
        return redirect()->route('admin.faq-type.all')->with('success', 'Faq type updated successfully!');
    }

    public function delete($id)
    {
        $this->faqTypeService->deleteFaqType($id);
        return redirect()->route('admin.faq-type.all')->with('success', 'Faq type deleted successfully.');
    }
}
