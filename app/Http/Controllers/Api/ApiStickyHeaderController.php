<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StickyHeaderResource;
use App\Models\StickyHeader;
use Illuminate\Http\Request;

class ApiStickyHeaderController extends Controller
{
    public function index()
    {
        $stickyHeaders = StickyHeader::latest()->get();
        return StickyHeaderResource::collection($stickyHeaders);
    }
}
