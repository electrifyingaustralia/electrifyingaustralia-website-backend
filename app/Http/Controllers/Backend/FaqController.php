<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\FaqCreateRequest;
use App\Http\Requests\Backend\FaqUpdateRequest;
use App\Services\Faq\FaqServiceInterface;
use App\Services\FaqType\FaqTypeServiceInterface;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(
        protected FaqServiceInterface $faqService,
        protected FaqTypeServiceInterface $faqTypeServiceInterface
    ) {}

    public function index()
    {
        $faqs = $this->faqService->get();
        $types = $this->faqTypeServiceInterface->get();
        return view('Backend.faq.index', compact('faqs', 'types'));
    }

    public function store(FaqCreateRequest $request)
    {
        $data = $request->validated();
        $this->faqService->createFaq($data);
        return redirect()->route('admin.faq.all')->with('success', 'FAQ created successfully!');
    }

    public function show(int $id)
    {
        $faq = $this->faqService->findFaq($id);
        return view('backend.faq.show', compact('faq'));
    }

    public function edit($id)
    {
        $faqToEdit = $this->faqService->findFaq($id);
        $faqs = $this->faqService->get();
        $types = $this->faqTypeServiceInterface->get();
        return view('Backend.faq.index', compact('faqToEdit', 'faqs', 'types'));
    }

    public function update(FaqUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->faqService->updateFaq($id, $data);
        return redirect()->route('admin.faq.all')->with('success', 'FAQ updated successfully!');
    }

    public function destroy($id)
    {
        $this->faqService->deleteFaq($id);
        return redirect()->route('admin.faq.all')->with('success', 'FAQ deleted successfully');
    }
}
