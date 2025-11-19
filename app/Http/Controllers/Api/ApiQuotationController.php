<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;
use App\Jobs\SendQuotationNotificationJob;
use App\Models\Answer;
use App\Models\Customer;
use App\Models\Question;
use App\Models\QuotationSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                "type" => "quotation"
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

                        $diskType = env("FILESYSTEM_DISK", "public");

                        $randomName = $file->store('quotation', $diskType);


                        $attrs = [
                            'original_name' => $file->getClientOriginalName(),
                            'random_name'  => basename($randomName),
                            'extension'    => $file->getClientOriginalExtension(),
                            'path'         => $randomName,
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

            SendQuotationNotificationJob::dispatch($customer);

            return response()->json([
                'message' => 'Customer quotation submitted successfully!',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to save quotation',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
