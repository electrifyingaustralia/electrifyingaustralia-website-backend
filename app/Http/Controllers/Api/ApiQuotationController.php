<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;
use App\Models\QuotationSection;
use Illuminate\Http\Request;

class ApiQuotationController extends Controller
{
    public function index()
    {
        $quotations = QuotationSection::with(['questions.options' => function ($query) {
            $query->orderBy('id', 'ASC');
        }])
            ->orderBy('created_at', 'ASC')
            ->get();

        return QuotationResource::collection($quotations);
    }
}
