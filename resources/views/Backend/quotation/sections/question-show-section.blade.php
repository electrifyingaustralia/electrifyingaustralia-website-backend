@extends('Backend.quotation.index')
@section('quotation-section')
<div id="quotation-tab" class="tab-content active">
    <div class="flex flex-col lg:!flex-row gap-6">
        <div class="w-full">

        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-normal text-gray-900">Question : <span class="font-medium">{{ $question->question }}</span></h3>
            </div>
            {{-- <div class="px-6 py-5">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <p class="text-lg text-gray-900">{{ $question->question }}</p>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-center">

                    <h3 class="text-lg font-normal text-gray-900">Options</h3>
                    <p class="text-sm font-medium text-gray-600 mt-1">Total options: {{ $question->options->count() }}</p>
                </div>
            </div>
            <div class="px-6 py-5">
                @if($question->options->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($question->options as $option)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                        {{ ucfirst($option->type) }}
                                    </span>
                                    <span class="text-xs text-gray-500">#{{ $loop->iteration }}</span>
                                </div>
                                <p class="text-gray-900">{{ $option->option }}</p>
                                <div class="mt-3 pt-3 border-t border-gray-100 text-xs text-gray-500">
                                    Created: {{ $option->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No options found</h3>
                        <p class="mt-1 text-sm text-gray-500">This question doesn't have any options yet.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.question.edit', $question->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Options
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action buttons -->
        {{-- <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.question.edit', $question->id) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                <div class="flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    <span>Edit Question</span>
                </div>
            </a>
        </div> --}}
    </div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
