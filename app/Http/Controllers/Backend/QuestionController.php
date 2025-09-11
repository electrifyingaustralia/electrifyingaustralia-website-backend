<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\QuestionRequest;
use App\Services\Question\QuestionServiceInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(protected QuestionServiceInterface $questionService) {}

    public function index()
    {
        $questions = $this->questionService->get();
        return view('backend.quotation.sections.question-section', compact('questions'));
    }
    public function create()
    {
        return view('backend.quotation.sections.question-create-section');
    }
    public function store(QuestionRequest $request)
    {
        $data = $request->validated();
        $this->questionService->createQuestion($data);
        return redirect()->route('admin.question.all')->with('success', 'Question created successfully!');
    }
    public function show($id)
    {
        $question = $this->questionService->findQuestion($id);
        return view('backend.quotation.sections.question-show-section', compact('question'));
    }
    public function edit($id)
    {
        $question = $this->questionService->findQuestion($id);
        return view('backend.quotation.sections.question-edit-section', compact('question'));
    }
    public function update(QuestionRequest $request, $id)
    {
        $data = $request->validated();
        $this->questionService->updateQuestion($id, $data);
        return redirect()->route('admin.question.all')->with('success', 'Question updated successfully!');
    }
    public function destroy($id)
    {
        $this->questionService->deleteQuestion($id);
        return redirect()->route('admin.question.all')->with('success', 'Question deleted successfully!');
    }
}
