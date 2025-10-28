<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Http\Resources\FaqTypeResource;
use App\Models\Faq;
use App\Models\FaqType;
use Illuminate\Http\Request;

class ApiFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->get();

        return FaqResource::collection($faqs);
    }

    public function getFaqTypes()
    {
        $types = FaqType::withCount('faqs')
            ->orderBy('id', 'ASC')
            ->limit(20)
            ->get();

        return FaqTypeResource::collection($types);
    }

    public function getFaqByType(Request $request)
    {
        $type = FaqType::when($request->filled('type'), function ($query) use ($request) {
            $query->where('slug', $request->query('type'));
        }, function ($query) {
            $query->orderBy("id", "ASC");
        })->first();

        $faqs = Faq::with('type')
            ->where('faq_type_id', $type->id ?? 0)
            ->where('is_active', true)
            ->latest()
            ->limit(20)
            ->get();

        return FaqResource::collection($faqs);
    }
}
