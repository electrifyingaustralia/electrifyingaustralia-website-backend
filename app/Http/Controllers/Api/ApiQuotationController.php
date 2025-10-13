<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;
use App\Models\Question;
use App\Models\QuotationSection;
use Illuminate\Http\Request;

class ApiQuotationController extends Controller
{
    public function index()
    {
        $quotations = QuotationSection::whereNull("parent_id")->orderBy('created_at', 'ASC')->get();
        return QuotationResource::collection($quotations);
    }

    public function findSubcategories($id)
    {
        $parentCategory = QuotationSection::with(['subCats'])
            ->findOrFail($id);

        return new QuotationResource($parentCategory);
    }

    public function findQuestions(Request $request)
    {
        $id = $request->id;

        $questions = QuotationSection::with(["questions", "questions.options"])->findOrFail($id);

        return $questions->questions;
    }
}
