@extends('Backend.quotation.index')
@section('quotation-section')
    <div class="max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Category: {{ $quotation->category }}</h2>
                    <p class="text-gray-600 mb-4">Subcategory: {{ $quotation->subcategory }}</p>
                    <div class="mt-6">
                        <h3 class="text-lg font-normal text-gray-800 mb-3">Assigned Questions</h3>
                        @if ($quotation->questions->count() > 0)
                            <ul class="space-y-4">
                                @foreach ($quotation->questions as $question)
                                    <li class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="text-md font-medium text-gray-900">{{ $question->question }}</h4>
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    @foreach ($question->options as $option)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                                            {{ $option->option }} ({{ $option->type }})
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-8 border border-dashed border-gray-300 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No questions assigned</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by adding questions to this section.</p>
                                <a href="{{ route('admin.quotation.assign-questions', $quotation->id) }}"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-md">
                                    Assign Questions
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quotation Details</h3>

                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Created At</p>
                                <p class="text-gray-800">{{ formatDate($quotation->created_at) }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600">Last Updated</p>
                                <p class="text-gray-800">{{ formatDate($quotation->updated_at) }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600">Total Questions</p>
                                <p class="text-gray-800">{{ $quotation->questions->count() }} questions</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.quotation.assign-questions', $quotation->id) }}"
                                class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-2">
                                    <path d="M12 5v14" />
                                    <path d="M5 12h14" />
                                </svg>
                                Manage Assigned Questions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
