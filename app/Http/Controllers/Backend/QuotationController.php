<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\QuestionAssignmentRequest;
use App\Http\Requests\Backend\QuotationRequest;
use App\Services\Question\QuestionServiceInterface;
use App\Services\Quotation\QuotationServiceInterface;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function __construct(
        protected QuotationServiceInterface $quotationService,
        protected QuestionServiceInterface $questionService
    ) {}

    public function index()
    {
        $quotations = $this->quotationService->get();
        return view('backend.quotation.sections.quotation-section', compact('quotations'));
    }

    public function store(QuotationRequest $request)
    {
        $data = $request->validated();
        $media = $request->file('media');
        $this->quotationService->createQuotation($data, $media);
        return redirect()->route('admin.quotation.all')->with('success', 'Quotation created successfully!');
    }

    public function show($id)
    {
        $quotation = $this->quotationService->findQuotation($id);
        return view('backend.quotation.sections.quotation-show', compact('quotation'));
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
        $media = $request->file('media');

        $this->quotationService->updateQuotation($id, $data, $media);
        return redirect()->route('admin.quotation.all')->with('success', 'Quotation updated successfully!');
    }

    public function destroy($id)
    {
        $this->quotationService->deleteQuotation($id);
        return redirect()->route('admin.quotation.all')->with('success', 'Quotation deleted successfully');
    }

    public function showAssignQuestions($id)
    {
        $section = $this->quotationService->findQuotation($id);
        $availableQuestions = $this->quotationService->getAvailableQuestions($id);

        return view('backend.quotation.sections.assign-questions', compact('section', 'availableQuestions'));
    }

    public function assignQuestions(QuestionAssignmentRequest $request, $id)
    {
        $data = $request->validated();

        if (isset($data['questions'])) {
            $this->quotationService->assignMultipleQuestions($id, $data['questions']);
            return redirect()->back()
                ->with('success', 'Questions assigned successfully!');
        }

        return redirect()->back()->with('error', 'No questions selected.');
    }

    public function removeQuestion($sectionId, $questionId)
    {
        $this->quotationService->removeQuestion($sectionId, $questionId);
        return redirect()->route('admin.quotation.assign-questions', $sectionId)
            ->with('success', 'Question removed successfully!');
    }

    public function updateQuestionOrder(Request $request, $sectionId)
    {
        $request->validate([
            'question_groups' => 'required|array',
            'question_groups.*' => 'array',
            'question_groups.*.*' => 'exists:questions,id'
        ]);

        $this->quotationService->updateQuestionOrder($sectionId, $request->question_groups);

        return response()->json(['success' => true, 'message' => 'Question order updated successfully']);
    }
}
