@extends('Backend.quotation.index')
@section('quotation-section')
<div id="quotation-tab" class="tab-content active">
    <div class="flex flex-col lg:!flex-row gap-6">
        <div class="w-full">
            <div class=" rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column - Assigned Questions -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Assigned Questions</h3>
                    <p class="text-sm text-gray-600 mt-1">Questions currently assigned to "{{ $section->title }}"</p>
                </div>
                <div class="px-6 py-5">
                    @if($section->questions->count() > 0)
                        <div class="space-y-4">
                            @foreach($section->questions as $question)
                                <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-md font-medium text-gray-900">{{ $question->question }}</h4>
                                        <div class="mt-2 flex flex-wrap gap-2">
                                            @foreach($question->options as $option)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                                    {{ $option->option }} ({{ $option->type }})
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.quotation.remove-question', [$section->id, $question->id]) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Remove this question from the section?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No questions assigned</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding questions from the available list.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column - Available Questions -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Available Questions</h3>
                    <p class="text-sm text-gray-600 mt-1">Questions that can be assigned to this section</p>
                </div>
                <div class="px-6 py-5">

                    <!-- Bulk Assign Form -->
                    @if($availableQuestions->count() > 0)
                        <form action="{{ route('admin.quotation.assign-questions', $section->id) }}" method="POST">
                            @csrf
                            <div class="max-h-96 overflow-y-auto mb-4">
                                @foreach($availableQuestions as $question)
                                    <div class="flex items-start mb-3 p-2 border border-gray-200 rounded-lg">
                                        <input
                                            id="question-{{ $question->id }}"
                                            type="checkbox"
                                            name="questions[]"
                                            value="{{ $question->id }}"
                                            class="mt-1 mr-2"
                                        >
                                        <label for="question-{{ $question->id }}" class="text-sm text-gray-700 flex-1">
                                            <div class="font-medium">{{ $question->question }}</div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $question->options->count() }} options
                                            </div>
                                            <div class="mt-1 flex flex-wrap gap-1">
                                                @foreach($question->options as $option)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $option->type }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="w-full !bg-teal-600 !hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                                Assign Selected Questions
                            </button>
                        </form>
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium !text-gray-900">All questions assigned</h3>
                            <p class="mt-1 text-sm !text-gray-500">All available questions have been assigned to this section.</p>
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
