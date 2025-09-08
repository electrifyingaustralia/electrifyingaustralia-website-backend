@extends('Backend.layouts.app')
@section('contents')
<div class="flex-1 p-3">
    <div class="max-w-[90rem] mx-auto">

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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">All Solution Cards</span>
                    </div>
                </li>
            </ol>
        </div>

        <div class="flex flex-col lg:!flex-row gap-6">
                <!-- Left Column - Table -->
                <div class="w-full lg:!w-2/3">
                    <!-- Sticky Headers Table -->
                    <div class="overflow-x-auto">
                        @if($cards->count() > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @foreach($cards as $card)
                            <div class="card bg-white rounded-xl overflow-hidden p-6">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center">
                                        <div>
                                            <h2 class="text-xl font-bold text-gray-800 max-w-[18rem] line-clamp-1">{{ $card->title }}</h2>
                                            <p class="text-gray-600 max-w-[18rem] line-clamp-3">{{ $card->description }}</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-1">
                                        <a href="{{ route('admin.package.show', $card->id) }}" class="action-btn bg-green-100 hover:bg-green-200 text-green-600 p-2 rounded-full" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{ route('admin.solution-card.edit', $card->id) }}" class="action-btn !bg-blue-100 hover:!bg-blue-200 !text-blue-600 p-2 rounded-full" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                        </a>
                                        <button onclick="confirmDelete({{ $card->id }})" class="action-btn bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-full" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        @if($cards->hasPages())
                            <div class="mt-6">
                                {{ $cards->links() }}
                            </div>
                        @endif
                        @else
                        <div class="bg-white rounded-lg shadow p-8 text-center">
                            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open-icon lucide-folder-open"><path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2"/></svg>
                            <h3 class="text-xl font-medium text-gray-700 my-2">No Solution Card Found</h3>
                            <p class="text-gray-500 mb-2">Get started by creating your first solution card.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column - Form -->
                <div class="w-full lg:!w-1/3">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">
                            {{ isset($cardToEdit) ? 'Edit Solution Card' : 'Add New Solution Card' }}
                        </h2>

                        <form action="{{ isset($cardToEdit) ? route('admin.solution-card.update', $cardToEdit->id) : route('admin.solution-card.store') }}" method="POST">
                            @csrf
                            @if(isset($cardToEdit))
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $cardToEdit->title ?? '') }}"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Enter title here..."
                                />
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" id="description"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Enter description here...">{{ old('description', $cardToEdit->description ?? '') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="bold_info" class="block text-sm font-medium text-gray-700 mb-1">Bold Info Content</label>
                                <input type="text" id="bold_info" name="bold_info" value="{{ old('bold_info', $cardToEdit->bold_info ?? '') }}"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Enter bold_info here..."
                                />
                                @error('bold_info')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="extra_info" class="block text-sm font-medium text-gray-700 mb-1">Extra Info Content</label>
                                <input type="text" id="extra_info" name="extra_info" value="{{ old('extra_info', $cardToEdit->extra_info ?? '') }}"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Enter extra_info here..."
                                />
                                @error('extra_info')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end mt-6">
                                @if(isset($cardToEdit))
                                    <a href="{{ route('admin.solution-card.all') }}" class="px-4 py-2 border !border-gray-300 rounded-lg text-gray-700 hover:!bg-gray-50 mr-2">
                                        Cancel
                                    </a>
                                @endif
                                <button type="submit" class="px-4 py-2 !bg-teal-600 text-white rounded-lg hover:!bg-teal-700">
                                    {{ isset($cardToEdit) ? 'Update' : 'Create' }} Solution Card
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this solution card? This action cannot be undone.</p>
        <div class="flex justify-end gap-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 !bg-red-600 text-white rounded-lg hover:!bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            const form = document.getElementById('delete-form');
            form.action = `/admin/solution-card/${id}`;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
@endpush
