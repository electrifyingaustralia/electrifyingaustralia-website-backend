@extends('Backend.layouts.app')
@section('contents')
    <div class="flex-1 p-6">
        <div class="max-w-5xl mx-auto">
            <!-- Breadcrumb and navigation code remains the same -->
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Create New Team Member</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.teams.all') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        <span>Back to All Team Members</span>
                    </div>
                </a>
            </div>

            <form id="team-form" action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col lg:!flex-row gap-6">
                    <div class="w-full lg:!w-2/3">
                        <!-- Sticky Headers Table -->
                        <div class="bg-white p-6 rounded-lg shadow">

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name <span
                                            class="text-red-600">*</span></label>
                                    <input type="text" id="name" name="name" required failed remove="name"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter team member name" />
                                </div>

                                <div>
                                    <label for="designation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Designation <span
                                            class="text-red-600">*</span></label>
                                    <input type="text" id="designation" name="designation" required failed
                                        remove="designation"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter team member designation" />
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter team member email" />
                                    @error('email')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                    <input type="text" id="phone" name="phone"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter team member phone" />
                                    @error('phone')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description
                                    </label>

                                    <textarea name="description"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter team member description">{{ old('description') }}</textarea>

                                    @error('description')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" id="status"
                                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <!-- Media Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Media</label>

                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <!-- Media Preview -->
                                        <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50"
                                            id="logo-preview">
                                            <div class="text-center text-gray-400">
                                                <i class="fas fa-image text-2xl mb-2"></i>
                                                <p class="text-xs">No media selected</p>
                                            </div>
                                        </div>

                                        <!-- Media Actions -->
                                        <div class="flex flex-col justify-center gap-2">
                                            <button type="button" id="open-media-library"
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
                                                    <span>Upload New Media</span>
                                                </div>
                                            </button>

                                            <input type="hidden" id="selected-media-id" name="media_id">
                                        </div>
                                    </div>

                                    <!-- Selected Media Info -->
                                    <div id="selected-logo-info" class="mt-3 p-3 bg-gray-50 rounded-lg hidden">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <!-- This will be dynamically populated based on file type -->
                                                <div id="selected-logo-preview-container">
                                                    <img id="selected-logo-preview" src="" alt="Selected media"
                                                        class="w-12 h-12 object-cover rounded hidden">
                                                    <div id="selected-logo-icon"
                                                        class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded hidden">
                                                        <svg id="selected-logo-svg" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide"></svg>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p id="selected-logo-name" class="text-sm font-medium"></p>
                                                    <p id="selected-logo-size" class="text-xs text-gray-500"></p>
                                                </div>
                                            </div>
                                            <button type="button" id="remove-selected-logo"
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
                            </div>
                        </div>
                    </div>
                    <!-- Right Column - Form -->
                    <div class="w-full lg:!w-1/3">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="facebook_link"
                                        class="block text-sm font-medium text-gray-700 mb-2">Facebook Link</label>
                                    <input type="url" id="facebook_link" name="facebook_link"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter facebook link" />
                                    @error('facebook_link')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="twitter_link" class="block text-sm font-medium text-gray-700 mb-2">Twitter
                                        Link</label>
                                    <input type="url" id="twitter_link" name="twitter_link"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter twitter link" />
                                    @error('twitter_link')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="linkedin_link"
                                        class="block text-sm font-medium text-gray-700 mb-2">Linkedin Link</label>
                                    <input type="url" id="linkedin_link" name="linkedin_link"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter linkedin link" />
                                    @error('linkedin_link')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="pinterest_link"
                                        class="block text-sm font-medium text-gray-700 mb-2">Pinterest Link</label>
                                    <input type="url" id="pinterest_link" name="pinterest_link"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter linkedin link" />
                                    @error('pinterest_link')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="youtube_link" class="block text-sm font-medium text-gray-700 mb-2">Youtube
                                        Link</label>
                                    <input type="url" id="youtube_link" name="youtube_link"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter youtube link" />
                                    @error('youtube_link')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Form Actions -->
                                <div class="mt-4 flex justify-end space-x-3">
                                    <button type="submit"
                                        class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                                        <div class="flex items-center gap-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-save-icon lucide-save">
                                                <path
                                                    d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                                <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                                <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                                            </svg>
                                            <span>Create Team Member</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Media Library Modal -->
    <div id="media-library-modal"
        class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-lg w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-medium">Upload or Select Media</h3>
                <button id="close-media-library" class="text-gray-400 hover:text-gray-600">
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
                    <button id="upload-tab" class="px-6 py-3 border-b-2 border-teal-600 text-teal-600 font-medium">
                        <i class="fas fa-upload mr-2"></i> Upload New
                    </button>
                    <button id="library-tab"
                        class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700">
                        <i class="fas fa-image mr-2"></i> Media Library
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="flex-1 overflow-auto min-h-[30rem]">
                <!-- Upload Tab -->
                <div id="upload-tab-content" class="p-6">
                    <div id="upload-area"
                        class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center relative">
                        <div id="upload-default" class="upload-content">
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
                            <input type="file" id="modal-logo-upload" class="hidden">
                            <label for="modal-logo-upload"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                                <i class="fas fa-upload mr-2"></i> Browse Files
                            </label>
                            {{-- <p class="text-xs text-gray-500 mt-3">Supported formats: JPG, PNG, GIF, SVG • Max size: 10MB</p> --}}
                        </div>

                        <div id="upload-preview" class="upload-content hidden">
                            <div class="flex flex-col items-center">
                                <!-- Preview container that will show appropriate content based on file type -->
                                <div id="preview-container"
                                    class="w-32 h-32 flex items-center justify-center mb-4 rounded-lg bg-gray-100">
                                    <!-- Image preview (default) -->
                                    <img id="preview-image" src="" alt="Preview"
                                        class="w-full h-full object-contain hidden">

                                    <!-- Video preview -->
                                    <video id="preview-video" class="w-full h-full object-contain hidden" controls>
                                        Your browser does not support the video tag.
                                    </video>

                                    <!-- Document preview icons -->
                                    <div id="preview-document" class="hidden flex flex-col items-center justify-center">
                                        <svg id="preview-icon" xmlns="http://www.w3.org/2000/svg" width="48"
                                            height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide"></svg>
                                        <p id="preview-extension" class="text-xs font-medium mt-1"></p>
                                    </div>
                                </div>

                                <p id="preview-filename" class="text-sm font-medium text-gray-700 mb-2"></p>
                                <p id="preview-size" class="text-xs text-gray-500 mb-4"></p>

                                <!-- Progress Bar -->
                                <div id="upload-progress-container"
                                    class="w-full bg-gray-200 rounded-full h-2.5 mb-4 hidden">
                                    <div id="upload-progress-bar" class="bg-teal-600 h-2.5 rounded-full"
                                        style="width: 0%"></div>
                                </div>
                                <p id="upload-status" class="text-xs text-gray-500 mb-2 hidden"></p>

                                <button id="clear-upload-preview" class="!text-red-600 hover:!text-red-800 text-sm">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Library Tab -->
                <div id="library-tab-content" class="p-6 hidden">
                    <div id="media-library-content" class="min-h-64">
                        <div class="text-center py-12">
                            <i class="fas fa-spinner fa-spin text-blue-500 text-2xl"></i>
                            <p class="mt-2 text-gray-600">Loading media library...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab-specific buttons -->
            <!-- Upload Tab Buttons -->
            <div id="upload-tab-buttons" class="flex justify-end p-6 border-t bg-gray-50 gap-x-2 hidden">
                <button id="cancel-upload" class="!bg-gray-600 hover:!bg-gray-700 text-white px-4 py-2 rounded-lg mr-3">
                    Cancel
                </button>
                <button id="upload-to-library" class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg"
                    disabled>
                    Upload to Media Library
                </button>
            </div>

            <!-- Library Tab Buttons -->
            <div id="library-tab-buttons" class="flex justify-end p-6 border-t bg-gray-50 gap-x-2 hidden">
                <button id="cancel-media-selection"
                    class="!bg-gray-600 hover:!bg-gray-700 text-white px-4 py-2 rounded-lg mr-3">
                    Cancel
                </button>
                <button id="confirm-selection" class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg"
                    disabled>
                    Select Media
                </button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .media-item.selected {
            border: 2px solid #0d9488;
            background-color: #f0fdfa;
        }

        .tab-active {
            border-bottom-color: #0d9488 !important;
            color: #0d9488 !important;
        }

        .upload-content {
            transition: all 0.3s ease;
        }

        #upload-area {
            transition: all 0.3s ease;
            min-height: 30rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #upload-area.dragover {
            background-color: #f0f9ff;
            border-color: #0ea5e9;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {

            $("[remove]").click(function() {
                const fields = ["INPUT", "TEXTAREA", "SELECT"];
                if (fields.includes(this.tagName)) {
                    var name = $(this).attr("name");
                    var remove = $(this).attr("remove");
                    if ($(this).attr("failed") != undefined && name) {
                        $(`[target="error-${name}"]`).remove();
                    } else if (remove) {
                        $(`[target="error-${remove}"]`).remove();
                    }
                }
            });

            let selectedMedia = null;
            let currentTab = 'upload';
            let mediaLibraryItems = [];
            let isUploading = false;

            // ========== UPLOAD TAB FUNCTIONS ==========
            function setupDragAndDrop() {
                const $uploadArea = $('#upload-area');

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
                        handleDroppedFile(files[0]);
                    }
                    unhighlight();
                };

                // Remove existing listeners and add new ones
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

            function handleDroppedFile(file) {
                validateAndProcessFile(file);
            }

            function validateAndProcessFile(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showUploadPreview(file, e.target.result);

                    selectedMedia = {
                        id: null,
                        url: e.target.result,
                        name: file.name,
                        size: file.size,
                        file: file,
                        type: 'upload'
                    };

                    updateUploadButtonState();
                };
                reader.readAsDataURL(file);
            }

            function showUploadPreview(file, dataUrl) {
                $('#upload-default').addClass('hidden');
                $('#upload-preview').removeClass('hidden');

                // Hide all preview elements first
                $('#preview-image').addClass('hidden');
                $('#preview-video').addClass('hidden');
                $('#preview-document').addClass('hidden');

                // Hide progress elements initially
                $('#upload-progress-container').addClass('hidden');
                $('#upload-status').addClass('hidden');

                // Determine file type and show appropriate preview
                const fileType = file.type;
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (fileType.startsWith('image/')) {
                    // Show image preview
                    $('#preview-image')
                        .attr('src', dataUrl)
                        .removeClass('hidden');
                } else if (fileType.startsWith('video/')) {
                    // Show video preview
                    $('#preview-video')
                        .attr('src', dataUrl)
                        .removeClass('hidden');
                } else {
                    // Show document icon based on file type
                    $('#preview-document').removeClass('hidden');

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

                    $('#preview-icon').html(iconSvg);
                    $('#preview-extension').text(fileExtension.toUpperCase());
                    $('#preview-container').removeClass().addClass(
                        `w-32 h-32 flex items-center justify-center mb-4 rounded-lg ${bgColor}`);
                }

                $('#preview-filename').text(file.name);
                $('#preview-size').text(formatFileSize(file.size));
            }

            function clearUploadPreview() {
                $('#upload-preview').addClass('hidden');
                $('#upload-default').removeClass('hidden');
                $('#modal-logo-upload').val('');

                // Reset all preview elements
                $('#preview-image').addClass('hidden').attr('src', '');
                $('#preview-video').addClass('hidden').attr('src', '');
                $('#preview-document').addClass('hidden');
                $('#preview-container').removeClass().addClass(
                    'w-32 h-32 flex items-center justify-center mb-4 rounded-lg bg-gray-100');

                // Reset progress
                $('#upload-progress-bar').css('width', '0%');
                $('#upload-progress-container').addClass('hidden');
                $('#upload-status').addClass('hidden');

                if (selectedMedia && selectedMedia.type === 'upload') {
                    selectedMedia = null;
                    updateUploadButtonState();
                }
            }

            function updateUploadButtonState() {
                const $uploadButton = $('#upload-to-library');
                if (selectedMedia && selectedMedia.type === 'upload' && !isUploading) {
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

            function uploadToLibrary() {
                if (!selectedMedia || selectedMedia.type !== 'upload' || isUploading) {
                    return;
                }

                isUploading = true;
                updateUploadButtonState();

                // Show progress elements
                $('#upload-progress-container').removeClass('hidden');
                $('#upload-status').removeClass('hidden').text('Uploading...');

                const formData = new FormData();
                formData.append('files[]', selectedMedia.file);

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
                                $('#upload-progress-bar').css('width', percentComplete + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(data) {
                        if (data.success && data.items && data.items.length > 0) {
                            $('#upload-status').text('Upload complete!');

                            // Add the new media to the library
                            const newMedia = data.items[0];
                            mediaLibraryItems.unshift(newMedia);

                            // Switch to library tab and select the new item
                            switchTab('library');
                            renderMediaLibrary(mediaLibraryItems);

                            // Select the newly uploaded item
                            setTimeout(function() {
                                selectMediaFromLibrary(0);
                            }, 300);
                        } else {
                            $('#upload-status').text('Upload failed!');
                            alert('Error uploading media');
                        }
                        isUploading = false;
                        updateUploadButtonState();
                    },
                    error: function(error) {
                        console.error('Error uploading media:', error);
                        $('#upload-status').text('Upload failed!');
                        alert('Error uploading media');
                        isUploading = false;
                        updateUploadButtonState();
                    }
                });
            }

            // ========== LIBRARY TAB FUNCTIONS ==========
            function loadMediaLibrary() {
                const $mediaContent = $('#media-library-content');
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
                            mediaLibraryItems = data.data;
                            renderMediaLibrary(data.data);
                        } else {
                            showNoMediaMessage();
                        }
                    },
                    error: function(error) {
                        console.error('Error loading media library:', error);
                        showErrorLoadingMedia();
                    }
                });
            }

            function renderMediaLibrary(mediaItems) {
                const $mediaContent = $('#media-library-content');

                let html = '<div class="grid !grid-cols-2 sm:!grid-cols-3 md:!grid-cols-4 lg:!grid-cols-6 !gap-4">';

                $.each(mediaItems, function(index, media) {
                    // Determine file type and appropriate preview
                    let previewHtml = '';
                    const fileExtension = media.original_name.split('.').pop().toLowerCase();

                    if (media.mime_type && media.mime_type.startsWith('image/')) {
                        // Image files - show thumbnail
                        previewHtml =
                            `<img src="${media.url}" alt="${media.original_name}" class="w-full h-24 object-scale-down">`;
                    } else if (media.mime_type && media.mime_type.startsWith('video/')) {
                        // Video files - show video icon
                        previewHtml = `
                    <div class="w-full h-24 flex items-center justify-center bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video text-gray-600">
                            <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/>
                            <rect x="2" y="6" width="14" height="12" rx="2"/>
                        </svg>
                    </div>
                `;
                    } else if (['pdf'].includes(fileExtension)) {
                        // PDF files - show PDF icon
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
                        // Word documents - show document icon
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
                        // Excel files - show spreadsheet icon
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
                        // Other file types - show generic file icon
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
                <div class="media-item bg-gray-100 rounded-lg overflow-hidden cursor-pointer transition-all hover:shadow-md"
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

                // Add click event listeners
                $mediaContent.find('.media-item').on('click', function() {
                    const index = parseInt($(this).data('index'));
                    selectMediaFromLibrary(index);
                });
            }

            function selectMediaFromLibrary(index) {
                const media = mediaLibraryItems[index];

                // Remove previous selection
                $('.media-item').removeClass('selected');

                // Add selection to current item
                $(`.media-item[data-index="${index}"]`).addClass('selected');

                selectedMedia = {
                    id: media.id,
                    url: media.url,
                    name: media.original_name,
                    size: media.file_size,
                    file: null,
                    type: 'library'
                };

                updateConfirmButtonState();
            }

            function showNoMediaMessage() {
                $('#media-library-content').html(`
            <div class="text-center py-12">
                <i class="fas fa-folder-open text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700">No media files found</h3>
                <p class="text-gray-500 mt-2">Upload images to use as media</p>
            </div>
        `);
            }

            function showErrorLoadingMedia() {
                $('#media-library-content').html(`
            <div class="text-center py-12">
                <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700">Error loading media</h3>
                <p class="text-gray-500 mt-2">Please try again</p>
            </div>
        `);
            }

            // ========== GENERAL MODAL FUNCTIONS ==========
            function updateConfirmButtonState() {
                const $confirmButton = $('#confirm-selection');
                if (selectedMedia) {
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

            function switchTab(tab) {
                currentTab = tab;

                // Update tab buttons
                $('#upload-tab, #library-tab').removeClass('tab-active');
                $('#upload-tab-content, #library-tab-content').addClass('hidden');
                $('#upload-tab-buttons, #library-tab-buttons').addClass('hidden');

                if (tab === 'upload') {
                    $('#upload-tab').addClass('tab-active');
                    $('#upload-tab-content').removeClass('hidden');
                    $('#upload-tab-buttons').removeClass('hidden');
                } else {
                    $('#library-tab').addClass('tab-active');
                    $('#library-tab-content').removeClass('hidden');
                    $('#library-tab-buttons').removeClass('hidden');

                    if ($('.media-item').length === 0) {
                        loadMediaLibrary();
                    }
                }
                updateConfirmButtonState();
                updateUploadButtonState();
            }

            function openMediaLibrary() {
                $('#media-library-modal').removeClass('hidden');
                switchTab('upload');
                setupDragAndDrop();

                selectedMedia = null;
                updateConfirmButtonState();
                updateUploadButtonState();
            }

            function closeMediaLibrary() {
                $('#media-library-modal').addClass('hidden');
                selectedMedia = null;
                updateConfirmButtonState();
                updateUploadButtonState();
                clearUploadPreview();
            }

            function confirmMediaSelection() {
                if (!selectedMedia) {
                    alert('Please select a media first');
                    return;
                }

                if (selectedMedia.type === 'library') {
                    applySelectedMedia();
                }
            }

            function applySelectedMedia() {
                $('#selected-media-id').val(selectedMedia.id);

                // Determine file type and show appropriate preview
                const fileExtension = selectedMedia.name.split('.').pop().toLowerCase();

                if (selectedMedia.url.match(/\.(jpg|jpeg|png|gif|svg|webp)$/i) ||
                    (selectedMedia.mime_type && selectedMedia.mime_type.startsWith('image/'))) {
                    // Image files
                    $('#logo-preview').html(
                        `<img src="${selectedMedia.url}" alt="${selectedMedia.name}" class="w-full h-full object-cover rounded-lg">`
                    );
                } else if (selectedMedia.url.match(/\.(mp4|webm|ogg|mov|avi|wmv)$/i) ||
                    (selectedMedia.mime_type && selectedMedia.mime_type.startsWith('video/'))) {
                    // Video files
                    $('#logo-preview').html(`
                <div class="w-full h-full flex items-center justify-center bg-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video text-gray-600">
                        <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"></path>
                        <rect x="2" y="6" width="14" height="12" rx="2"></rect>
                    </svg>
                </div>
            `);
                } else {
                    // Document files - show appropriate icon
                    let bgColor = 'bg-gray-200';
                    let iconSvg = '';

                    switch (fileExtension) {
                        case 'pdf':
                            bgColor = 'bg-red-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 极 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
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

                    $('#logo-preview').html(`
                <div class="w-full h-full flex items-center justify-center ${bgColor} rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="极 0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide">
                        ${iconSvg}
                    </svg>
                </div>
            `);
                }

                // Update selected logo info
                if (selectedMedia.url.match(/\.(jpg|jpeg|png|gif|svg|webp)$/i) ||
                    (selectedMedia.mime_type && selectedMedia.mime_type.startsWith('image/'))) {
                    // Show image preview
                    $('#selected-logo-preview').attr('src', selectedMedia.url).removeClass('hidden');
                    $('#selected-logo-icon').addClass('hidden');
                } else {
                    // Show icon preview
                    $('#selected-logo-preview').addClass('hidden');
                    $('#selected-logo-icon').removeClass('hidden');

                    let bgColor = 'bg-gray-200';
                    let iconSvg = '';

                    switch (fileExtension) {
                        case 'pdf':
                            bgColor = 'bg-red-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2极 4"/><path d="M极 10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
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

                    $('#selected-logo-icon').removeClass().addClass(
                        `w-12 h-12 flex items-center justify-center ${bgColor} rounded`);
                    $('#selected-logo-svg').html(iconSvg);
                }

                $('#selected-logo-name').text(selectedMedia.name);
                $('#selected-logo-size').text(formatFileSize(selectedMedia.size));
                $('#selected-logo-info').removeClass('hidden');

                closeMediaLibrary();
            }

            function removeSelectedLogo() {
                $('#logo-preview').html(`
            <div class="text-center text-gray-400">
                <i class="fas fa-image text-2xl mb-2"></i>
                <p class="text-xs">No media selected</p>
            </div>
        `);

                $('#selected-logo-info').addClass('hidden');
                $('#selected-media-id').val('');
                selectedMedia = null;
                updateConfirmButtonState();
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function handleFormErrorMessage(xhr) {
                // Handle errors
                if (xhr.status === 422) {

                    var errors = xhr.responseJSON.errors;

                    for (var field in errors) {

                        var message =
                            `<p class="!text-red-600 text-sm mt-1 validation-error-message " target="error-${field}">${errors[field][0]}</p>`;
                        var target = $('input[name="' + field + '"]');
                        var targetElement = $('[failed="' + field + '"]');

                        if (target && target.attr("failed") != undefined) {
                            target.after(message);
                        } else if (targetElement) {
                            targetElement.html(message);
                        }
                    }

                } else {
                    toastr.error('An error occurred. Please try again.');
                }

                $('button[type="submit"]').prop('disabled', false).text('Create Blog');
            }

            // Event bindings
            $('#open-media-library').on('click', openMediaLibrary);
            $('#close-media-library, #cancel-upload, #cancel-media-selection').on('click', closeMediaLibrary);
            $('#upload-tab').on('click', function() {
                switchTab('upload');
            });
            $('#library-tab').on('click', function() {
                switchTab('library');
            });
            $('#modal-logo-upload').on('change', function() {
                if (this.files && this.files[0]) {
                    validateAndProcessFile(this.files[0]);
                }
            });
            $('#clear-upload-preview').on('click', clearUploadPreview);
            $('#upload-to-library').on('click', uploadToLibrary);
            $('#confirm-selection').on('click', confirmMediaSelection);
            $('#remove-selected-logo').on('click', removeSelectedLogo);

            // Form Submission
            $('#team-form').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true).text('Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            // Store the success message in localStorage
                            localStorage.setItem('toastr_success', response.message) ||
                                '{{ route('admin.teams.all') }}';

                            // Redirect to index page
                            window.location.href = response.redirect;
                        } else {
                            toastr.error(response.message || 'An error occurred');
                            $('button[type="submit"]').prop('disabled', false).text(
                                'Create Team Member');
                        }
                    },
                    error: (error) => {
                        handleFormErrorMessage(error);
                    }
                });
            });
        });
    </script>
@endpush
