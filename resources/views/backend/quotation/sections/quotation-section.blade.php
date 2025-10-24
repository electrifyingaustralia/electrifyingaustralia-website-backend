@extends('backend.quotation.index')
@section('quotation-section')
    <div id="quotation-tab" class="tab-content active">
        <div class="flex flex-col lg:!flex-row gap-6">
            <div class="w-full lg:!w-2/3">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="bg-gray-100 text-gray-700 text-xs">
                                <tr>
                                    <th class="px-4 py-3 w-3/5">Category</th>
                                    <th class="px-4 py-3 w-3/5">Parent Category</th>
                                    <th class="pr-8 py-3 w-2/5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($quotations as $quotation)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-2">
                                                @if ($quotation->media_url)
                                                    <img src="{{ $quotation->media_url }}" alt="{{ $quotation->category }}"
                                                        class="w-8 h-8 object-cover rounded">
                                                @endif
                                                <div class="max-w-[15rem] truncate" title="{{ $quotation->category }}">
                                                    {{ $quotation->category }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            @if (optional($quotation->parentCat)->id)
                                                <div class="max-w-[10rem] truncate">
                                                    [ {{ $quotation->parentCat->category }} ]
                                                </div>
                                            @else
                                                <span class="text-red-500">[ Not available ]</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 flex justify-end items-center gap-x-2">
                                            @if ($quotation->parentCat)
                                                <a href="{{ route('admin.quotation.show', $quotation->id) }}"
                                                    class="text-green-500 hover:text-green-700 p-1 rounded hover:bg-green-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 fill-green-500 hover:fill-green-700"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12c-4.411 0-7.757-3.134-9.223-5
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    1.466-1.866 4.812-5 9.223-5s7.757 3.134 9.223 5c-1.466 1.866-4.812 5-9.223 5z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if (!$quotation->subCats->count())
                                                <a href="{{ route('admin.quotation.assign-questions', $quotation->id) }}"
                                                    title="Assign Questions"
                                                    class="text-green-500 hover:text-green-700 p-1 rounded hover:bg-green-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="#e9f910" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-file-question-mark-icon lucide-file-question-mark">
                                                        <path d="M12 17h.01" />
                                                        <path
                                                            d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                                                        <path d="M9.1 9a3 3 0 0 1 5.82 1c0 2-3 3-3 3" />
                                                    </svg>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.quotation.edit', $quotation->id) }}"
                                                class="text-blue-500 hover:text-blue-700 p-1 rounded hover:bg-blue-50">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4 fill-blue-500 hover:fill-blue-700"
                                                    viewBox="0 0 348.882 348.882">
                                                    <path
                                                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                                        data-original="#000000" />
                                                    <path
                                                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                                        data-original="#000000" />
                                                </svg>
                                            </a>
                                            <button class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50"
                                                type="button" onclick="confirmDelete({{ $quotation->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                                        data-original="#000000" />
                                                    <path
                                                        d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                                        data-original="#000000" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center font-medium text-gray-700">
                                            <div class="flex flex-col items-center justify-center gap-x-4 py-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-folder-open-icon lucide-folder-open">
                                                    <path
                                                        d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2" />
                                                </svg>
                                                <span class="pt-2 text-lg">No Quotation found.</span>
                                            </div>
                                            <span class="text-gray-500">Create your first Quotation to get started!</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @include('backend.components.pagination', ['paginator' => $quotations])
                </div>
            </div>
            <div class="w-full lg:!w-1/3">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">
                        {{ isset($quotationToEdit) ? 'Edit Quotation' : 'Add New Quotation' }}
                    </h2>

                    <form
                        action="{{ isset($quotationToEdit) ? route('admin.quotation.update', $quotationToEdit->id) : route('admin.quotation.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($quotationToEdit))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category <span
                                    class="text-red-600 font-bold">*</span></label>
                            <input type="text" id="category" name="category" failed remove="category"
                                value="{{ old('category', $quotationToEdit->category ?? '') }}"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                placeholder="Enter your category here..." />
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $isSubCategory = isset($quotationToEdit) && optional($quotationToEdit->parentCat)->id;
                        @endphp

                        <!-- Media Selection Section - Only show for parent categories -->
                        @if (!$isSubCategory)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category Media</label>

                                <div class="flex flex-col sm:flex-row gap-4">
                                    <!-- Media Preview -->
                                    <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50"
                                        id="quotation-media-preview">
                                        @if (isset($quotationToEdit) && $quotationToEdit->media_url)
                                            <img src="{{ $quotationToEdit->media_url }}"
                                                alt="{{ $quotationToEdit->category }}"
                                                class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="text-center text-gray-400">
                                                <i class="fas fa-image text-2xl mb-2"></i>
                                                <p class="text-xs">No media selected</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Media Actions -->
                                    <div class="flex flex-col justify-center gap-2">
                                        <button type="button" id="open-quotation-media-library"
                                            class="!bg-[#006494] hover:!bg-[#003554] text-white px-4 py-2 rounded-lg">
                                            <div class="flex items-center gap-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-upload-icon lucide-upload">
                                                    <path d="M12 3v12" />
                                                    <path d="m17 8-5-5-5 5" />
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                </svg>
                                                <span>Upload Media</span>
                                            </div>
                                        </button>

                                        <input type="hidden" id="selected-quotation-media-id" name="media_id"
                                            value="{{ isset($quotationToEdit) ? $quotationToEdit->media_id : '' }}">

                                        <input type="file" name="media" class="hidden">
                                    </div>
                                </div>

                                <!-- Selected Media Info - Always show this section but keep it hidden initially -->
                                <div id="selected-quotation-media-info"
                                    class="mt-3 p-3 bg-gray-50 rounded-lg {{ isset($quotationToEdit) && $quotationToEdit->media_url ? '' : 'hidden' }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div id="selected-quotation-media-preview-container">
                                                @if (isset($quotationToEdit) && $quotationToEdit->media_url)
                                                    <img id="selected-quotation-media-preview"
                                                        src="{{ $quotationToEdit->media_url }}" alt="Selected media"
                                                        class="w-12 h-12 object-cover rounded">
                                                @else
                                                    <div id="selected-quotation-media-icon"
                                                        class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded hidden">
                                                        <svg id="selected-quotation-media-svg"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide"></svg>
                                                    </div>
                                                    <img id="selected-quotation-media-preview" src=""
                                                        alt="Selected media"
                                                        class="w-12 h-12 object-cover rounded hidden">
                                                @endif
                                            </div>
                                            <div>
                                                <p id="selected-quotation-media-name" class="text-sm font-medium">
                                                    @if (isset($quotationToEdit) && $quotationToEdit->media_url)
                                                        {{ $quotationToEdit->media->original_name ?? 'Media file' }}
                                                    @else
                                                        No media selected
                                                    @endif
                                                </p>
                                                <p id="selected-quotation-media-size" class="text-xs text-gray-500">
                                                    @if (isset($quotationToEdit) && $quotationToEdit->media_url)
                                                        {{ $quotationToEdit->media->file_size ?? '' }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <button type="button" id="remove-selected-quotation-media"
                                            class="text-red-600 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash2-icon lucide-trash-2">
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                                <path d="M3 6h18"></path>
                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-700">Media can only be added to parent categories, not
                                    sub-categories.</p>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">Add
                                Sub-Categories</label>

                            @if ($isSubCategory)
                                <div class="bg-gray-100 p-3 rounded-lg text-gray-600 text-sm">
                                    <p>Sub-categories cannot be added to existing sub-categories.</p>
                                    <p class="mt-1">Parent:
                                        <strong>{{ $quotationToEdit->parentCat->category ?? 'N/A' }}</strong>
                                    </p>
                                </div>
                            @else
                                <div id="add_new_sub_cat_fields" class="flex flex-col gap-y-3">
                                    <div class="flex gap-x-3 items-center">
                                        <input name="subcategory[]"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Enter your subcategory here..." />
                                        <span class="size-6 flex justify-center items-center cursor-pointer text-red-600"
                                            id="delete_sub_cat">X</span>
                                    </div>
                                </div>
                                @error('subcategory')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <div class="flex justify-between gap-1 mt-6">
                            @if (!$isSubCategory)
                                <button class="!bg-[#006494] hover:!bg-[#003554] text-white px-3 py-1 rounded-lg"
                                    id="add_new_sub_cat_btn" type="button">Add new</button>
                            @else
                                <div></div> <!-- Empty div to maintain flex layout -->
                            @endif

                            @if (isset($quotationToEdit))
                                <a href="{{ route('admin.quotation.all') }}"
                                    class="px-3 py-1 border !border-gray-300 rounded-lg text-gray-700 hover:!bg-gray-50 mr-2">
                                    Cancel
                                </a>
                            @endif
                            <button type="submit"
                                class="px-3 py-1 !bg-teal-600 text-white rounded-lg hover:!bg-teal-700">
                                {{ isset($quotationToEdit) ? 'Update' : 'Create' }} Quotation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this FAQ? This action cannot be undone.</p>
            <div class="flex justify-end gap-x-3">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 !bg-red-600 text-white rounded-lg hover:!bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Media Library Modal - Only include if not a sub-category -->
    @if (!isset($quotationToEdit) || !optional($quotationToEdit->parentCat)->id)
        <div id="quotation-media-library-modal"
            class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
            <div class="bg-white rounded-lg w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-medium">Upload or Select Media</h3>
                    <button id="close-quotation-media-library" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Tabs -->
                <div class="border-b">
                    <div class="flex">
                        <button id="quotation-upload-tab"
                            class="px-6 py-3 border-b-2 border-teal-600 text-teal-600 font-medium">
                            <i class="fas fa-upload mr-2"></i> Upload New
                        </button>
                        <button id="quotation-library-tab"
                            class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700">
                            <i class="fas fa-image mr-2"></i> Media Library
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="flex-1 overflow-auto min-h-[30rem]">
                    <!-- Upload Tab -->
                    <div id="quotation-upload-tab-content" class="p-6">
                        <div id="quotation-upload-area"
                            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center relative">
                            <div id="quotation-upload-default" class="quotation-upload-content">
                                <div class="mx-auto w-16 h-16 text-gray-400 mb-4">
                                    <div class="mx-auto w-18 text-gray-400 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="m-auto text-center" width="40"
                                            height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-plus-icon lucide-plus">
                                            <path d="M5 12h14" />
                                            <path d="M12 5v14" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Drag & drop your media here or click to browse</p>
                                <input type="file" id="quotation-modal-logo-upload" class="hidden">
                                <label for="quotation-modal-logo-upload"
                                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                                    <i class="fas fa-upload mr-2"></i> Browse Files
                                </label>
                            </div>

                            <div id="quotation-upload-preview" class="quotation-upload-content hidden">
                                <div class="flex flex-col items-center">
                                    <!-- Preview container -->
                                    <div id="quotation-preview-container"
                                        class="w-32 h-32 flex items-center justify-center mb-4 rounded-lg bg-gray-100">
                                        <!-- Image preview -->
                                        <img id="quotation-preview-image" src="" alt="Preview"
                                            class="w-full h-full object-contain hidden">

                                        <!-- Video preview -->
                                        <video id="quotation-preview-video" class="w-full h-full object-contain hidden"
                                            controls>
                                            Your browser does not support the video tag.
                                        </video>

                                        <!-- Document preview icons -->
                                        <div id="quotation-preview-document"
                                            class="hidden flex flex-col items-center justify-center">
                                            <svg id="quotation-preview-icon" xmlns="http://www.w3.org/2000/svg"
                                                width="48" height="48" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="lucide"></svg>
                                            <p id="quotation-preview-extension" class="text-xs font-medium mt-1"></p>
                                        </div>
                                    </div>

                                    <p id="quotation-preview-filename" class="text-sm font-medium text-gray-700 mb-2"></p>
                                    <p id="quotation-preview-size" class="text-xs text-gray-500 mb-4"></p>

                                    <!-- Progress Bar -->
                                    <div id="quotation-upload-progress-container"
                                        class="w-full bg-gray-200 rounded-full h-2.5 mb-4 hidden">
                                        <div id="quotation-upload-progress-bar" class="bg-teal-600 h-2.5 rounded-full"
                                            style="width: 0%"></div>
                                    </div>
                                    <p id="quotation-upload-status" class="text-xs text-gray-500 mb-2 hidden"></p>

                                    <button id="quotation-clear-upload-preview"
                                        class="!text-red-600 hover:!text-red-800 text-sm">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Library Tab -->
                    <div id="quotation-library-tab-content" class="p-6 hidden">
                        <div id="quotation-media-library-content" class="min-h-64">
                            <div class="text-center py-12">
                                <i class="fas fa-spinner fa-spin text-blue-500 text-2xl"></i>
                                <p class="mt-2 text-gray-600">Loading media library...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab-specific buttons -->
                <!-- Upload Tab Buttons -->
                <div id="quotation-upload-tab-buttons" class="flex justify-end p-6 border-t bg-gray-50 gap-x-2 hidden">
                    <button id="quotation-cancel-upload"
                        class="!bg-gray-600 hover:!bg-gray-700 text-white px-4 py-2 rounded-lg mr-3">
                        Cancel
                    </button>
                    <button id="quotation-upload-to-library"
                        class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg" disabled>
                        Upload to Media Library
                    </button>
                </div>

                <!-- Library Tab Buttons -->
                <div id="quotation-library-tab-buttons" class="flex justify-end p-6 border-t bg-gray-50 gap-x-2 hidden">
                    <button id="quotation-cancel-media-selection"
                        class="!bg-gray-600 hover:!bg-gray-700 text-white px-4 py-2 rounded-lg mr-3">
                        Cancel
                    </button>
                    <button id="quotation-confirm-selection"
                        class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg" disabled>
                        Select Media
                    </button>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        .quotation-media-item.selected {
            border: 2px solid #0d9488;
            background-color: #f0fdfa;
        }

        .quotation-tab-active {
            border-bottom-color: #0d9488 !important;
            color: #0d9488 !important;
        }

        .quotation-upload-content {
            transition: all 0.3s ease;
        }

        #quotation-upload-area {
            transition: all 0.3s ease;
            min-height: 30rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #quotation-upload-area.dragover {
            background-color: #f0f9ff;
            border-color: #0ea5e9;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Quotation Media Library JavaScript
            let quotationSelectedMedia = null;
            let quotationCurrentTab = 'upload';
            let quotationMediaLibraryItems = [];
            let quotationIsUploading = false;

            // ========== UPLOAD TAB FUNCTIONS ==========
            function setupQuotationDragAndDrop() {
                const $uploadArea = $('#quotation-upload-area');

                const preventDefaults = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                };

                const highlight = () => {
                    $uploadArea.addClass('bg-blue-50 border-blue-400');
                };

                const unhighlight = () => {
                    $uploadArea.removeClass('bg-blue-50 border-blue-400');
                };

                const handleDrop = (e) => {
                    const dt = e.originalEvent.dataTransfer;
                    const files = dt.files;

                    if (files.length > 0) {
                        handleQuotationDroppedFile(files[0]);
                    }
                    unhighlight();
                };

                $uploadArea
                    .off('dragenter dragover dragleave drop')
                    .on('dragenter', preventDefaults)
                    .on('dragover', function(e) {
                        preventDefaults(e);
                        highlight();
                    })
                    .on('dragleave', function(e) {
                        preventDefaults(e);
                        unhighlight();
                    })
                    .on('drop', function(e) {
                        preventDefaults(e);
                        handleDrop(e);
                    });
            }

            function handleQuotationDroppedFile(file) {
                validateAndProcessQuotationFile(file);
            }

            function validateAndProcessQuotationFile(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showQuotationUploadPreview(file, e.target.result);

                    quotationSelectedMedia = {
                        id: null,
                        url: e.target.result,
                        name: file.name,
                        size: file.size,
                        file: file,
                        type: 'upload'
                    };

                    updateQuotationUploadButtonState();
                };
                reader.readAsDataURL(file);
            }

            function showQuotationUploadPreview(file, dataUrl) {
                $('#quotation-upload-default').addClass('hidden');
                $('#quotation-upload-preview').removeClass('hidden');

                $('#quotation-preview-image').addClass('hidden');
                $('#quotation-preview-video').addClass('hidden');
                $('#quotation-preview-document').addClass('hidden');

                $('#quotation-upload-progress-container').addClass('hidden');
                $('#quotation-upload-status').addClass('hidden');

                const fileType = file.type;
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (fileType.startsWith('image/')) {
                    $('#quotation-preview-image')
                        .attr('src', dataUrl)
                        .removeClass('hidden');
                } else if (fileType.startsWith('video/')) {
                    $('#quotation-preview-video')
                        .attr('src', dataUrl)
                        .removeClass('hidden');
                } else {
                    $('#quotation-preview-document').removeClass('hidden');

                    let iconSvg = '';
                    let bgColor = 'bg-gray-100';

                    switch (fileExtension) {
                        case 'pdf':
                            iconSvg = `
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            <path d="M10 9H8"/>
                            <path d="M16 13H8"/>
                            <path d="M16 17H8"/>
                        `;
                            bgColor = 'bg-red-100';
                            break;
                        case 'doc':
                        case 'docx':
                            iconSvg = `
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            <path d="M10 9H8"/>
                            <path d="M16 13H8"/>
                            <path d="M16 17H8"/>
                        `;
                            bgColor = 'bg-blue-100';
                            break;
                        case 'xls':
                        case 'xlsx':
                            iconSvg = `
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <path d="M3 9h18"/>
                            <path d="M3 15h18"/>
                            <path d="M9 3v18"/>
                            <path d="M15 3v18"/>
                        `;
                            bgColor = 'bg-green-100';
                            break;
                        default:
                            iconSvg = `
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                        `;
                    }

                    $('#quotation-preview-icon').html(iconSvg);
                    $('#quotation-preview-extension').text(fileExtension.toUpperCase());
                    $('#quotation-preview-container').removeClass().addClass(
                        `w-32 h-32 flex items-center justify-center mb-4 rounded-lg ${bgColor}`);
                }

                $('#quotation-preview-filename').text(file.name);
                $('#quotation-preview-size').text(formatQuotationFileSize(file.size));
            }

            function clearQuotationUploadPreview() {
                $('#quotation-upload-preview').addClass('hidden');
                $('#quotation-upload-default').removeClass('hidden');
                $('#quotation-modal-logo-upload').val('');

                $('#quotation-preview-image').addClass('hidden').attr('src', '');
                $('#quotation-preview-video').addClass('hidden').attr('src', '');
                $('#quotation-preview-document').addClass('hidden');
                $('#quotation-preview-container').removeClass().addClass(
                    'w-32 h-32 flex items-center justify-center mb-4 rounded-lg bg-gray-100');

                $('#quotation-upload-progress-bar').css('width', '0%');
                $('#quotation-upload-progress-container').addClass('hidden');
                $('#quotation-upload-status').addClass('hidden');

                if (quotationSelectedMedia && quotationSelectedMedia.type === 'upload') {
                    quotationSelectedMedia = null;
                    updateQuotationUploadButtonState();
                }
            }

            function updateQuotationUploadButtonState() {
                const $uploadButton = $('#quotation-upload-to-library');
                if (quotationSelectedMedia && quotationSelectedMedia.type === 'upload' && !quotationIsUploading) {
                    $uploadButton
                        .removeClass('bg-gray-400 cursor-not-allowed')
                        .addClass('bg-teal-600 hover:bg-teal-700')
                        .prop('disabled', false);
                } else {
                    $uploadButton
                        .removeClass('bg-teal-600 hover:bg-teal-700')
                        .addClass('bg-gray-400 cursor-not-allowed')
                        .prop('disabled', true);
                }
            }

            function uploadQuotationToLibrary() {
                if (!quotationSelectedMedia || quotationSelectedMedia.type !== 'upload' || quotationIsUploading) {
                    return;
                }

                quotationIsUploading = true;
                updateQuotationUploadButtonState();

                $('#quotation-upload-progress-container').removeClass('hidden');
                $('#quotation-upload-status').removeClass('hidden').text('Uploading...');

                const formData = new FormData();
                formData.append('files[]', quotationSelectedMedia.file);

                $.ajax({
                    url: '{{ route('admin.media.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                const percentComplete = (e.loaded / e.total) * 100;
                                $('#quotation-upload-progress-bar').css('width',
                                    percentComplete + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(data) {
                        if (data.success && data.items && data.items.length > 0) {
                            $('#quotation-upload-status').text('Upload complete!');

                            const newMedia = data.items[0];
                            quotationMediaLibraryItems.unshift(newMedia);

                            switchQuotationTab('library');
                            renderQuotationMediaLibrary(quotationMediaLibraryItems);

                            setTimeout(function() {
                                selectQuotationMediaFromLibrary(0);
                            }, 300);
                        } else {
                            $('#quotation-upload-status').text('Upload failed!');
                            alert('Error uploading media');
                        }
                        quotationIsUploading = false;
                        updateQuotationUploadButtonState();
                    },
                    error: function(error) {
                        console.error('Error uploading media:', error);
                        $('#quotation-upload-status').text('Upload failed!');
                        alert('Error uploading media');
                        quotationIsUploading = false;
                        updateQuotationUploadButtonState();
                    }
                });
            }

            // ========== LIBRARY TAB FUNCTIONS ==========
            function loadQuotationMediaLibrary() {
                const $mediaContent = $('#quotation-media-library-content');
                $mediaContent.html(`
                <div class="text-center py-12">
                    <i class="fas fa-spinner fa-spin text-blue-500 text-2xl"></i>
                    <p class="mt-2 text-gray-600">Loading media library...</p>
                </div>
            `);

                $.ajax({
                    url: '{{ route('admin.media.ajax.all') }}?perPage=15',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        if (data.data && data.data.length > 0) {
                            quotationMediaLibraryItems = data.data;
                            renderQuotationMediaLibrary(data.data);
                        } else {
                            showQuotationNoMediaMessage();
                        }
                    },
                    error: function(error) {
                        console.error('Error loading media library:', error);
                        showQuotationErrorLoadingMedia();
                    }
                });
            }

            function renderQuotationMediaLibrary(mediaItems) {
                const $mediaContent = $('#quotation-media-library-content');

                let html = '<div class="grid !grid-cols-2 sm:!grid-cols-3 md:!grid-cols-4 lg:!grid-cols-6 !gap-4">';

                $.each(mediaItems, function(index, media) {
                    let previewHtml = '';
                    const fileExtension = media.original_name.split('.').pop().toLowerCase();

                    if (media.mime_type && media.mime_type.startsWith('image/')) {
                        previewHtml =
                            `<img src="${media.url}" alt="${media.original_name}" class="w-full h-24 object-scale-down">`;
                    } else if (media.mime_type && media.mime_type.startsWith('video/')) {
                        previewHtml = `
                        <div class="w-full h-24 flex items-center justify-center bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video text-gray-600">
                                <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/>
                                <rect x="2" y="6" width="14" height="12" rx="2"/>
                            </svg>
                        </div>
                    `;
                    } else if (['pdf'].includes(fileExtension)) {
                        previewHtml = `
                        <div class="w-full h-24 flex items-center justify-center bg-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-red-600">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                <path d="M10 9H8"/>
                                <path d="M16 13H8"/>
                                <path d="M16 17H8"/>
                            </svg>
                        </div>
                    `;
                    } else if (['doc', 'docx'].includes(fileExtension)) {
                        previewHtml = `
                        <div class="w-full h-24 flex items-center justify-center bg-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-blue-600">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                <path d="M10 9H8"/>
                                <path d="M16 13H8"/>
                                <path d="M16 17H8"/>
                            </svg>
                        </div>
                    `;
                    } else if (['xls', 'xlsx'].includes(fileExtension)) {
                        previewHtml = `
                        <div class="w-full h-24 flex items-center justify-center bg-green-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-table text-green-600">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                                <path d="M3 9h18"/>
                                <path d="M3 15h18"/>
                                <path d="M9 3v18"/>
                                <path d="M15 3v18"/>
                            </svg>
                        </div>
                    `;
                    } else {
                        previewHtml = `
                        <div class="w-full h-24 flex items-center justify-center bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file text-gray-600">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            </svg>
                        </div>
                    `;
                    }

                    html += `
                    <div class="quotation-media-item bg-gray-100 rounded-lg overflow-hidden cursor-pointer transition-all hover:shadow-md"
                        data-index="${index}">
                        ${previewHtml}
                        <div class="p-2">
                            <p class="text-xs text-center font-medium truncate">${media.original_name}</p>
                        </div>
                    </div>
                `;
                });

                html += '</div>';
                $mediaContent.html(html);

                $mediaContent.find('.quotation-media-item').on('click', function() {
                    const index = parseInt($(this).data('index'));
                    selectQuotationMediaFromLibrary(index);
                });
            }

            function selectQuotationMediaFromLibrary(index) {
                const media = quotationMediaLibraryItems[index];

                $('.quotation-media-item').removeClass('selected');
                $(`.quotation-media-item[data-index="${index}"]`).addClass('selected');

                quotationSelectedMedia = {
                    id: media.id,
                    url: media.url,
                    name: media.original_name,
                    size: media.file_size,
                    file: null,
                    type: 'library'
                };

                updateQuotationConfirmButtonState();
            }

            function showQuotationNoMediaMessage() {
                $('#quotation-media-library-content').html(`
                <div class="text-center py-12">
                    <i class="fas fa-folder-open text-gray-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-700">No media files found</h3>
                    <p class="text-gray-500 mt-2">Upload images to use as media</p>
                </div>
            `);
            }

            function showQuotationErrorLoadingMedia() {
                $('#quotation-media-library-content').html(`
                <div class="text-center py-12">
                    <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-700">Error loading media</h3>
                    <p class="text-gray-500 mt-2">Please try again</p>
                </div>
            `);
            }

            // ========== GENERAL MODAL FUNCTIONS ==========
            function updateQuotationConfirmButtonState() {
                const $confirmButton = $('#quotation-confirm-selection');
                if (quotationSelectedMedia) {
                    $confirmButton
                        .removeClass('bg-gray-400 cursor-not-allowed')
                        .addClass('bg-teal-600 hover:bg-teal-700')
                        .prop('disabled', false);
                } else {
                    $confirmButton
                        .removeClass('bg-teal-600 hover:bg-teal-700')
                        .addClass('bg-gray-400 cursor-not-allowed')
                        .prop('disabled', true);
                }
            }

            function switchQuotationTab(tab) {
                quotationCurrentTab = tab;

                $('#quotation-upload-tab, #quotation-library-tab').removeClass('quotation-tab-active');
                $('#quotation-upload-tab-content, #quotation-library-tab-content').addClass('hidden');
                $('#quotation-upload-tab-buttons, #quotation-library-tab-buttons').addClass('hidden');

                if (tab === 'upload') {
                    $('#quotation-upload-tab').addClass('quotation-tab-active');
                    $('#quotation-upload-tab-content').removeClass('hidden');
                    $('#quotation-upload-tab-buttons').removeClass('hidden');
                } else {
                    $('#quotation-library-tab').addClass('quotation-tab-active');
                    $('#quotation-library-tab-content').removeClass('hidden');
                    $('#quotation-library-tab-buttons').removeClass('hidden');

                    if ($('.quotation-media-item').length === 0) {
                        loadQuotationMediaLibrary();
                    }
                }
                updateQuotationConfirmButtonState();
                updateQuotationUploadButtonState();
            }

            function openQuotationMediaLibrary() {
                $('#quotation-media-library-modal').removeClass('hidden');
                switchQuotationTab('upload');
                setupQuotationDragAndDrop();

                quotationSelectedMedia = null;
                updateQuotationConfirmButtonState();
                updateQuotationUploadButtonState();
            }

            function closeQuotationMediaLibrary() {
                $('#quotation-media-library-modal').addClass('hidden');
                quotationSelectedMedia = null;
                updateQuotationConfirmButtonState();
                updateQuotationUploadButtonState();
                clearQuotationUploadPreview();
            }

            function confirmQuotationMediaSelection() {
                if (!quotationSelectedMedia) {
                    alert('Please select a media first');
                    return;
                }

                if (quotationSelectedMedia.type === 'library') {
                    applyQuotationSelectedMedia();
                }
            }

            function applyQuotationSelectedMedia() {
                $('#selected-quotation-media-id').val(quotationSelectedMedia.id);

                const fileExtension = quotationSelectedMedia.name.split('.').pop().toLowerCase();

                if (quotationSelectedMedia.url.match(/\.(jpg|jpeg|png|gif|svg|webp)$/i) ||
                    (quotationSelectedMedia.mime_type && quotationSelectedMedia.mime_type.startsWith('image/'))) {
                    $('#quotation-media-preview').html(
                        `<img src="${quotationSelectedMedia.url}" alt="${quotationSelectedMedia.name}" class="w-full h-full object-cover rounded-lg">`
                    );
                } else if (quotationSelectedMedia.url.match(/\.(mp4|webm|ogg|mov|avi|wmv)$/i) ||
                    (quotationSelectedMedia.mime_type && quotationSelectedMedia.mime_type.startsWith('video/'))) {
                    $('#quotation-media-preview').html(`
                    <div class="w-full h-full flex items-center justify-center bg-gray-200 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video text-gray-600">
                            <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"></path>
                            <rect x="2" y="6" width="14" height="12" rx="2"></rect>
                        </svg>
                    </div>
                `);
                } else {
                    let bgColor = 'bg-gray-200';
                    let iconSvg = '';

                    switch (fileExtension) {
                        case 'pdf':
                            bgColor = 'bg-red-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                            break;
                        case 'doc':
                        case 'docx':
                            bgColor = 'bg-blue-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                            break;
                        case 'xls':
                        case 'xlsx':
                            bgColor = 'bg-green-100';
                            iconSvg =
                                '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/>';
                            break;
                        default:
                            bgColor = 'bg-gray-200';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/>';
                    }

                    $('#quotation-media-preview').html(`
                    <div class="w-full h-full flex items-center justify-center ${bgColor} rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide">
                            ${iconSvg}
                        </svg>
                    </div>
                `);
                }

                // Update selected media info - FIXED: Always update the info section
                $('#selected-quotation-media-info').removeClass('hidden');

                if (quotationSelectedMedia.url.match(/\.(jpg|jpeg|png|gif|svg|webp)$/i) ||
                    (quotationSelectedMedia.mime_type && quotationSelectedMedia.mime_type.startsWith('image/'))) {
                    $('#selected-quotation-media-preview').attr('src', quotationSelectedMedia.url).removeClass(
                        'hidden');
                    $('#selected-quotation-media-icon').addClass('hidden');
                } else {
                    $('#selected-quotation-media-preview').addClass('hidden');
                    $('#selected-quotation-media-icon').removeClass('hidden');

                    let bgColor = 'bg-gray-200';
                    let iconSvg = '';

                    switch (fileExtension) {
                        case 'pdf':
                            bgColor = 'bg-red-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                            break;
                        case 'doc':
                        case 'docx':
                            bgColor = 'bg-blue-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                            break;
                        case 'xls':
                        case 'xlsx':
                            bgColor = 'bg-green-100';
                            iconSvg =
                                '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/>';
                            break;
                        default:
                            bgColor = 'bg-gray-200';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/>';
                    }

                    $('#selected-quotation-media-icon').removeClass().addClass(
                        `w-12 h-12 flex items-center justify-center ${bgColor} rounded`);
                    $('#selected-quotation-media-svg').html(iconSvg);
                }

                $('#selected-quotation-media-name').text(quotationSelectedMedia.name);
                $('#selected-quotation-media-size').text(formatQuotationFileSize(quotationSelectedMedia.size));

                closeQuotationMediaLibrary();
            }

            function removeQuotationSelectedMedia() {
                $('#quotation-media-preview').html(`
                <div class="text-center text-gray-400">
                    <i class="fas fa-image text-2xl mb-2"></i>
                    <p class="text-xs">No media selected</p>
                </div>
            `);

                $('#selected-quotation-media-info').addClass('hidden');
                $('#selected-quotation-media-id').val('');
                quotationSelectedMedia = null;
                updateQuotationConfirmButtonState();
            }

            function formatQuotationFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Event bindings - Only bind if media library exists (not a sub-category)
            @if (!isset($quotationToEdit) || !optional($quotationToEdit->parentCat)->id)
                $('#open-quotation-media-library').on('click', openQuotationMediaLibrary);
                $('#close-quotation-media-library, #quotation-cancel-upload, #quotation-cancel-media-selection').on(
                    'click', closeQuotationMediaLibrary);
                $('#quotation-upload-tab').on('click', function() {
                    switchQuotationTab('upload');
                });
                $('#quotation-library-tab').on('click', function() {
                    switchQuotationTab('library');
                });
                $('#quotation-modal-logo-upload').on('change', function() {
                    if (this.files && this.files[0]) {
                        validateAndProcessQuotationFile(this.files[0]);
                    }
                });
                $('#quotation-clear-upload-preview').on('click', clearQuotationUploadPreview);
                $('#quotation-upload-to-library').on('click', uploadQuotationToLibrary);
                $('#quotation-confirm-selection').on('click', confirmQuotationMediaSelection);
                $('#remove-selected-quotation-media').on('click', removeQuotationSelectedMedia);
            @endif


        });
    </script>
@endpush

@push('scripts')
    <script>
        function confirmDelete(id) {
            const form = document.getElementById('delete-form');
            form.action = `/admin/quotation/${id}`;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        // Only initialize the sub-category functionality if the current item is not a sub-category
        @if (!isset($quotationToEdit) || !optional($quotationToEdit->parentCat)->id)
            $(document).ready(function() {
                $("#add_new_sub_cat_btn").click(function() {
                    $("#add_new_sub_cat_fields").append(`<div class="flex gap-x-3 items-center">
                                        <input name="subcategory[]"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Enter your subcategory here..." />
                                        <span class="size-6 flex justify-center items-center text-red-600 cursor-pointer" id="delete_sub_cat">X</span>
                                    </div>`);
                });

                $(document).on("click", "#delete_sub_cat", function() {
                    if ($(this).prev().val() == "") {
                        return this.closest("div").remove();
                    }

                    if (confirm("Are you sure delete this ?")) {
                        this.closest("div").remove();
                    }
                });
            });
        @endif
    </script>
@endpush
