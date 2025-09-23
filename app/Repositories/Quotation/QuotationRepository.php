<?php

namespace App\Repositories\Quotation;

use App\Models\Question;
use App\Repositories\Quotation\QuotationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\QuotationSection;
use Illuminate\Support\Facades\DB;

class QuotationRepository implements QuotationRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function query(): Builder
    {
        return QuotationSection::query();
    }

    public function get(array $columns = ["*"], int $perPage = 15): object
    {
        return $this->query()->select($columns)->latest('id')->paginate($perPage);
    }

    public function all(): object
    {
        return $this->query()->all();
    }

    public function list(): object
    {
        return $this->query()->get();
    }

    public function find(int $id): object
    {
        return $this->query()->findOrFail($id);
    }

    public function view(int $id): object
    {
        $instance = $this->find($id);
        return $instance;
    }

    public function create(array $data): object
    {
        return QuotationSection::create($data);
    }

    public function update(int $id, array $data): object
    {
        $instance = $this->find($id);
        $instance->update($data);
        return $instance;
    }

    public function exists(int | array $id): bool
    {
        if (is_array($id)) {
            return $this->query()->where($id)->exists();
        }

        return $this->query()->where("id", $id)->exists();
    }

    public function delete(int $id): bool
    {
        $instance = $this->find($id);
        return $instance->delete();
    }

    public function getAvailableQuestions($sectionId)
    {
        $section = QuotationSection::findOrFail($sectionId);

        $assignedQuestionIds = $section->questions()->pluck('questions.id');

        return Question::with('options')
            ->whereNotIn('id', $assignedQuestionIds)
            ->get();
    }

    public function attachQuestions($sectionId, $questionIds)
    {
        $section = QuotationSection::findOrFail($sectionId);
        return $section->questions()->attach($questionIds);
    }

    public function detachQuestion($sectionId, $questionId)
    {
        $section = QuotationSection::findOrFail($sectionId);
        return $section->questions()->detach($questionId);
    }

    public function syncQuestions($sectionId, array $questionIds)
    {
        $section = QuotationSection::findOrFail($sectionId);
        return $section->questions()->sync($questionIds);
    }

    public function updateQuestionOrder($sectionId, $questionIds)
    {
        $section = QuotationSection::findOrFail($sectionId);

        foreach ($questionIds as $order => $questionId) {
            DB::table('quotation_section_question')
                ->where('quotation_section_id', $sectionId)
                ->where('question_id', $questionId)
                ->update(['order' => $order + 1]);
        }

        return true;
    }

    public function getOrderedQuestions($sectionId)
    {
        return DB::table('quotation_section_question')
            ->where('quotation_section_id', $sectionId)
            ->join('questions', 'quotation_section_question.question_id', '=', 'questions.id')
            ->orderBy('quotation_section_question.order')
            ->select('questions.*', 'quotation_section_question.order')
            ->get();
    }
}
