<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [];
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        return view('backend.product.create');
    }
}
