@extends('backend.layouts.app')
@section('contents')
    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <div class="flex justify-between items-center mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-lg font-medium text-gray-700 hover:!text-teal-600">
                            <svg class="w-5 h-5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="inline-flex items-center text-lg font-medium text-gray-700">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            Products
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">View Product</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.product.all') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        <span>Back to All Products</span>
                    </div>
                </a>
            </div>

            <!-- Product Details Card -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                                <p class="text-gray-600 mb-1">Model: {{ $product->model_number }}</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-sm text-gray-600">Brand: </span>
                                    <span class="ml-2 text-gray-800 font-medium">{{ $product->brand->name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $product->short_description }}</p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-1 gap-4">
                            <h4 class="text-md font-semibold text-gray-800 ">Specifications</h4>
                            <div class="bg-teal-50 p-4 rounded-lg">
                                <ul class="space-y-2 text-sm">
                                    <li class="flex justify-between">
                                        <span class="text-teal-600">Warranty</span>
                                        <span class="text-teal-800 font-medium">{{ $product->warranty }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-teal-600">Type</span>
                                        <span class="text-teal-800 font-medium">{{ $product->type->name }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-teal-600">Featured</span>
                                        <span class="text-teal-800 font-medium">
                                            @if ($product->is_featured)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </span>
                                    </li>

                                    <li class="flex justify-between">
                                        <span class="text-teal-600">Status</span>
                                        @if ($product->is_active)
                                            <span class="!text-teal-800 font-medium ">Active</span>
                                        @else
                                            <span class="!text-red-800 font-medium ">Inactive</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Product Details</h3>

                            <div class="mb-4">
                                <img src="{{ $product->media_url }}" alt="Solar Panel"
                                    class="w-full h-48 object-scale-down rounded-lg">
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600">Created At</p>
                                    <p class="text-gray-800">{{ formatDate($product->created_at) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Last Updated</p>
                                    <p class="text-gray-800">{{ formatDate($product->updated_at) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Product Type</p>
                                    <p class="text-gray-800">{{ $product->product_type }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Product Link</p>
                                    <a href="{{ $product->product_link }}" target="_blank"
                                        class="text-teal-600 hover:text-teal-800 break-words">{{ $product->product_link }}</a>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg flex items-center justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path
                                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                    </svg>
                                    Edit Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
