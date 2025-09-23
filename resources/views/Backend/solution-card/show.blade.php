@extends('Backend.layouts.app')
@section('contents')
<div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <div class="flex justify-between items-center mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-lg font-medium text-gray-700 hover:!text-teal-600">
                            <svg class="w-5 h-5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="inline-flex items-center text-lg font-medium text-gray-700">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            Solution Cards
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">View Solution Card</span>
                        </div>
                    </li>
                </ol>
                <a href="#" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                        </svg>
                        <span>Back to Solution Cards</span>
                    </div>
                </a>
            </div>

            <!-- Solution Card Details -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $card->title }}</h2>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $card->description }}</p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-1 gap-4">
                            <h4 class="text-md font-semibold text-gray-800">Specifications</h4>
                            <div class="bg-teal-50 p-4 rounded-lg">
                                <ul class="space-y-2 text-sm">
                                    <li class="flex justify-between">
                                        <span class="text-teal-600">Bold Content</span>
                                        <span class="text-teal-800 font-medium">{{ $card->bold_info }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-teal-600">Extra Info</span>
                                        <span class="text-teal-800 font-medium">{{ $card->extra_info }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        <div class="bg-gray-50 p-4 rounded-lg top-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Card Details</h3>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600">Created At</p>
                                    <p class="text-gray-800">{{ formatDate($card->created_at) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Last Updated</p>
                                    <p class="text-gray-800">{{ formatDate($card->updated_at) }}</p>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <a href="{{ route('admin.solution-card.edit', $card->id) }}" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg flex items-center justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                    </svg>
                                    Edit Solution Card
                                </a>

                                <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this solution card?')">
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                        </svg>
                                        Delete Solution Card
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Cards Section -->
            {{-- <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Solution Highlights</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="info-card bg-white p-6 rounded-lg shadow">
                        <div class="flex items-start mb-4">
                            <div class="bg-teal-100 p-3 rounded-full mr-4">
                                <i class="fas fa-sun text-teal-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Energy Independence</h4>
                                <p class="text-gray-600 text-sm mt-1">Generate your own clean energy and reduce reliance on the grid</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white p-6 rounded-lg shadow">
                        <div class="flex items-start mb-4">
                            <div class="bg-blue-100 p-3 rounded-full mr-4">
                                <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Long-Term Savings</h4>
                                <p class="text-gray-600 text-sm mt-1">Significant reduction in electricity costs over the system lifespan</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white p-6 rounded-lg shadow">
                        <div class="flex items-start mb-4">
                            <div class="bg-green-100 p-3 rounded-full mr-4">
                                <i class="fas fa-leaf text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Environmental Impact</h4>
                                <p class="text-gray-600 text-sm mt-1">Reduce your carbon footprint with clean, renewable energy</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white p-6 rounded-lg shadow">
                        <div class="flex items-start mb-4">
                            <div class="bg-purple-100 p-3 rounded-full mr-4">
                                <i class="fas fa-shield-alt text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Reliability</h4>
                                <p class="text-gray-600 text-sm mt-1">Premium equipment with extensive warranties for peace of mind</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
