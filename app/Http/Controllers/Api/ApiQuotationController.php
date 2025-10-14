<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;
use App\Models\Answer;
use App\Models\Customer;
use App\Models\Question;
use App\Models\QuotationSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function saveCustomerQuotation(Request $request)
    {

        try {
            DB::beginTransaction();

            $answers = (array) $request->answers;

            $catId = $request->category_id;

            $subCatId = $request->sub_cat_id;

            $files = $request->allFiles();

            $customer = Customer::create([
                "category_id" => $catId,
                "sub_category_id" => $subCatId,
            ]);

            foreach ($answers as $answer) {
                try {
                    $attrs = json_decode($answer, true);

                    if (!isset($attrs["answer"])) {
                        continue;
                    }

                    $payload = [
                        "customer_id" => $customer->id,
                        "question_id" => $attrs["id"],
                        "answer_type" => $attrs["input_type"],
                        "answer" => [
                            "value" => $attrs["answer"],
                        ]
                    ];

                    Answer::create($payload);
                } catch (Exception $error) {
                }
            }


            foreach ($files as $key => $f) {

                try {
                    $file = $request->file($key);
                    if ($file->isValid()) {

                        $randomName = uniqid() . '.' . $file->getClientOriginalExtension();

                        $destinationPath = public_path('quotation');

                        $file->move($destinationPath, $randomName);

                        $attrs = [
                            'original_name' => $file->getClientOriginalName(),
                            'random_name'  => $randomName,
                            'extension'    => $file->getClientOriginalExtension(),
                            // 'size'         => $file->getSize(),
                            'path'         => 'quotation/' . $randomName,
                        ];

                        $questionId = str_replace("answer_file_", "", $key);

                        $payload = [
                            "customer_id" => $customer->id,
                            "question_id" => $questionId,
                            "answer_type" => "file",
                            "answer" => $attrs,
                        ];

                        Answer::create($payload);
                    }
                } catch (Exception $error) {
                }
            }
            DB::commit();

            return response()->json([
                'message' => 'Customer quotation submitted successful!',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to save quotation',
                'error' => $e->getMessage()
            ], 500);
        }


        try {
            DB::beginTransaction();
            $customer = Customer::create([
                'first_name' => $request->input('customer_info.first_name'),
                'last_name' => $request->input('customer_info.last_name'),
                'email' => $request->input('customer_info.email'),
                'phone' => $request->input('customer_info.phone'),
                'address' => $request->input('customer_info.address'),
                'type' => $request->input('customer_info.type'),
                'status' => 'pending',
            ]);

            $answers = $request->input('answers', []);
            foreach ($answers as $answerData) {
                $answerValue = $this->processAnswerBasedOnType($answerData);

                Answer::create([
                    'customer_id' => $customer->id,
                    'question_id' => $answerData['question_id'] ?? null,
                    'answer' => $answerValue,
                    'type' => $answerData['type'] ?? 'text',
                ]);
            }

            if ($request->hasFile('files')) {
                $this->handleFileUploads($request->file('files'), $customer->id);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to save quotation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function processAnswerBasedOnType($answerData)
    {
        $type = $answerData['type'] ?? 'text';
        $answer = $answerData['answer'] ?? null;

        switch ($type) {
            case 'radio':
            case 'select':
                return $answer;

            case 'checkbox':
                if (is_array($answer)) {
                    return implode(', ', $answer);
                }
                return $answer;

            case 'file':
                return $answerData['file_path'] ?? null;

            case 'text':
            case 'number':
            default:
                return $answer;
        }
    }

    private function handleFileUploads($files, $customerId)
    {
        foreach ($files as $fileData) {
            if (isset($fileData['file']) && $fileData['file']->isValid()) {
                $file = $fileData['file'];
                $questionId = $fileData['question_id'] ?? null;

                $filename = 'quotation_' . $customerId . '_' . time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('quotations/files', $filename, 'public');

                if ($questionId) {
                    Answer::create([
                        'customer_id' => $customerId,
                        'question_id' => $questionId,
                        'answer' => $path,
                        'type' => 'file',
                    ]);
                }
            }
        }
    }
}
