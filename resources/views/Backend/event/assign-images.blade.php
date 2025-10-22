@extends('Backend.layouts.app')
@section('contents')
    @push('styles')
        <style>
            .media-item.selected {
                border: 2px solid #0d9488;
                background-color: #f0fdfa;
            }

            #selected-images-container {
                min-height: 200px;
            }

            .remove-media {
                display: none;
            }

            .media-item:hover .remove-media {
                display: block !important;
            }

            .tab-active {
                border-bottom-color: #0d9488 !important;
                color: #0d9488 !important;
            }

            .checkbox-container {
                position: absolute;
                top: 5px;
                left: 5px;
                z-index: 10;
            }

            .media-item {
                position: relative;
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

    <div class="flex-1 p-6">
        <div class="max-w-5xl mx-auto">
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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('admin.event.all') }}"
                                class="ml-1 text-lg font-medium text-gray-极0 hover:!text-teal-600 md:ml-2">Events</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 极 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Assign Images to Event</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.event.all') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        <span>Back to Events</span>
                    </div>
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Assign Images to: {{ $event->title }}</h2>

                <form id="assign-images-form" action="{{ route('admin.event.store-images', $event->id) }}" method="POST">
                    @csrf

                    <!-- Selected Images -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Selected Images</h3>
                        <div id="selected-images-container"
                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-48">
                            <div id="no-images-message" class="text-center py-8 text-gray-500">
                                <i class="fas fa-image mb-2"></i>
                                <p>No images selected. Select images from the media library below.</p>
                            </div>
                            <div id="selected-images-list" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            </div>
                        </div>
                    </div>

                    <!-- Media Library -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Media Library</h3>
                        <div class="flex justify-between items-center mb-4">
                            <button type="button" id="open-media-library"
                                class="!bg-[#006494] hover:!bg-[#003554] text-white px-4 py-2 rounded-lg">
                                <div class="flex items-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-image-icon lucide-image">
                                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                        <path d="m21 15-5-5-5 5" />
                                        <path d="m11 15 2-2 2 2" />
                                    </svg>
                                    <span>Select from Media Library</span>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected media IDs -->
                    <input type="hidden" name="media_ids" id="media-ids" value="">

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.event.all') }}"
                            class="!bg-gray-600 hover:!bg-gray-700 text-white px-6 py-2 rounded-lg">
                            Cancel
                        </a>
                        <button type="submit" class="!bg-teal-600 hover:!极-teal-700 text-white px-6 py-2 rounded-lg">
                            Save Images
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Media Library Modal -->
    <div id="media-library-modal"
        class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-lg w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-medium">Upload or Select Media (Multiple Selection)</h3>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-plus-icon lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Drag & drop your media here or click to browse</p>
                            <input type="file" id="modal-logo-upload" class="hidden" multiple>
                            <label for="modal-logo-upload"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                                <i class="fas fa-upload mr-2"></i> Browse Files
                            </label>
                        </div>

                        <div id="upload-preview" class="upload-content hidden">
                            <div class="flex flex-col items-center">
                                <!-- Multiple files preview container -->
                                <div id="multiple-files-preview" class="w-full mb-4 hidden">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-medium text-gray-700">Selected Files (<span
                                                id="file-count">0</span>)</h4>
                                    </div>
                                    <div id="files-preview-grid"
                                        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 max-h-64 overflow-y-auto p-2 border border-gray-200 rounded-lg">
                                        <!-- Dynamic preview items will be added here -->
                                    </div>
                                </div>

                                <!-- Single file preview container (for backward compatibility) -->
                                <div id="single-file-preview" class="hidden">
                                    <div id="preview-container"
                                        class="w-32 h-32 flex items-center justify-center mb-4 rounded-lg bg-gray-100">
                                        <!-- Image preview (default) -->
                                        <img id="preview-image" src="" alt="Preview"
                                            class="w-full h-full object-scale-down hidden">
                                        <!-- Video preview -->
                                        <video id="preview-video" class="w-full h-full object-contain hidden" controls>
                                            Your browser does not support the video tag.
                                        </video>
                                        <!-- Document preview icons -->
                                        <div id="preview-document"
                                            class="hidden flex flex-col items-center justify-center">
                                            <svg id="preview-icon" xmlns="http://www.w3.org/2000/svg" width="48"
                                                height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide"></svg>
                                            <p id="preview-extension" class="text-xs font-medium mt-1"></p>
                                        </div>
                                    </div>
                                    <p id="preview-filename" class="text-sm font-medium text-gray-700 mb-2"></p>
                                    <p id="preview-size" class="text-xs text-gray-500 mb-4"></p>
                                </div>

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
                    <!-- Add this search bar -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" id="modal-media-search" placeholder="Search media..."
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <div class="absolute right-3 top-3 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>

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
                <button id="confirm-selection-multiple"
                    class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg">
                    Add Selected Media
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let selectedMediaItems = [];
            let modalSelectedMedia = [];
            let mediaLibraryItems = [];
            let currentTab = 'upload';
            let isUploading = false;
            let uploadedFiles = [];

            // Pagination variables
            let currentPage = 1;
            let lastPage = 1;
            let hasMorePages = true;
            let isLoadingMore = false;
            let currentSearchTerm = '';

            // Utility to format file size
            function humanFileSize(bytes) {
                const thresh = 1024;
                if (Math.abs(bytes) < thresh) return bytes + ' B';
                const units = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                let u = -1;
                do {
                    bytes /= thresh;
                    ++u;
                } while (Math.abs(bytes) >= thresh && u < units.length - 1);
                return bytes.toFixed(1) + ' ' + units[u];
            }

            // Load existing event images
            function loadEventImages() {
                $.ajax({
                    url: '{{ route('admin.event.images', $event->id) }}',
                    method: 'GET',
                    success: function(data) {
                        selectedMediaItems = data || [];
                        renderSelectedImages();
                        updateMediaIdsInput();
                    },
                    error: function(error) {
                        console.error('Error loading event images:', error);
                    }
                });
            }

            // Render selected images
            function renderSelectedImages() {
                const $selectedList = $('#selected-images-list');
                const $noImagesMessage = $('#no-images-message');

                $selectedList.empty();

                if (!selectedMediaItems || selectedMediaItems.length === 0) {
                    $noImagesMessage.removeClass('hidden');
                    return;
                }

                $noImagesMessage.addClass('hidden');

                selectedMediaItems.forEach((media) => {
                    const isImage = media.mime_type && media.mime_type.startsWith('image/');
                    const previewHtml = isImage ?
                        `<img src="${media.url}" alt="${media.original_name || media.name}" class="w-full h-24 object-scale-down rounded">` :
                        `<div class="w-full h-24 flex items-center justify-center bg-gray-200 rounded">
                    <i class="fas fa-file text-xl text-gray-600"></i>
                </div>`;

                    $selectedList.append(`
                    <div class="media-item bg-white rounded-lg overflow-hidden shadow relative" data-media-id="${media.id}">
                        ${previewHtml}
                        <div class="p-2">
                            <p class="text-xs font-medium truncate">${media.original_name || media.name}</p>
                        </div>
                        <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 remove-media" data-media-id="${media.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e81717" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>
                `);
                });
            }

            // Update hidden input with media IDs
            function updateMediaIdsInput() {
                const mediaIds = selectedMediaItems.map(item => item.id).filter(Boolean);
                $('#media-ids').val(mediaIds.join(','));
            }

            // Add media to selection (used when uploading new items)
            function addMediaToSelection(mediaItems) {
                mediaItems.forEach(media => {
                    if (!selectedMediaItems.some(item => item.id === media.id)) {
                        selectedMediaItems.push(media);
                    }
                });

                renderSelectedImages();
                updateMediaIdsInput();
            }

            // Remove media from selection
            function removeMediaFromSelection(mediaId) {
                selectedMediaItems = selectedMediaItems.filter(item => item.id !== mediaId);
                renderSelectedImages();
                updateMediaIdsInput();
            }

            // ========== UPLOAD PREVIEW & UPLOAD TAB FUNCTIONS ==========
            function renderUploadPreview() {
                if (uploadedFiles.length === 0) {
                    $('#upload-preview').addClass('hidden');
                    $('#upload-default').removeClass('hidden');
                    $('#upload-progress-container').addClass('hidden');
                    $('#upload-status').addClass('hidden');
                    $('#multiple-files-preview').addClass('hidden');
                    $('#single-file-preview').addClass('hidden');
                    return;
                }

                $('#upload-default').addClass('hidden');
                $('#upload-preview').removeClass('hidden');
                $('#upload-progress-container').addClass('hidden');
                $('#upload-status').addClass('hidden');

                // Show appropriate preview based on number of files
                if (uploadedFiles.length === 1) {
                    // Single file preview
                    $('#multiple-files-preview').addClass('hidden');
                    $('#single-file-preview').removeClass('hidden');
                    renderSingleFilePreview(uploadedFiles[0]);
                } else {
                    // Multiple files preview
                    $('#single-file-preview').addClass('hidden');
                    $('#multiple-files-preview').removeClass('hidden');
                    renderMultipleFilesPreview();
                }
            }

            function renderSingleFilePreview(media) {
                const file = media.file;

                // hide all sub-previews first
                $('#preview-image').addClass('hidden').attr('src', '');
                $('#preview-video').addClass('hidden').attr('src', '');
                $('#preview-document').addClass('hidden');

                if (file.type && file.type.startsWith('image/')) {
                    $('#preview-image').attr('src', media.url).removeClass('hidden');
                } else if (file.type && file.type.startsWith('video/')) {
                    $('#preview-video').attr('src', media.previewUrl || media.url).removeClass('hidden');
                } else {
                    // document / other
                    const ext = (media.name || '').split('.').pop() || '';
                    $('#preview-extension').text(ext.toUpperCase());
                    $('#preview-document').removeClass('hidden');
                }

                $('#preview-filename').text(media.name || '');
                $('#preview-size').text(humanFileSize(media.size || 0));
            }

            function renderMultipleFilesPreview() {
                const $filesGrid = $('#files-preview-grid');
                const $fileCount = $('#file-count');

                $filesGrid.empty();
                $fileCount.text(uploadedFiles.length);

                uploadedFiles.forEach((media, index) => {
                    const file = media.file;
                    let previewHtml = '';
                    const fileExtension = (media.name || '').split('.').pop().toLowerCase();

                    if (file.type && file.type.startsWith('image/')) {
                        previewHtml =
                            `<img src="${media.url}" alt="${media.name}" class="w-full h-16 object-cover rounded">`;
                    } else if (file.type && file.type.startsWith('video/')) {
                        previewHtml = `
                        <div class="w-full h-16 flex items-center justify-center bg-gray-200 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video text-gray-600">
                                <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/>
                                <rect x="2" y="6" width="14" height="12" rx="2"/>
                            </svg>
                        </div>
                    `;
                    } else if (['pdf'].includes(fileExtension)) {
                        previewHtml = `
                        <div class="w-full h-16 flex items-center justify-center bg-red-100 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-red-600">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            </svg>
                        </div>
                    `;
                    } else {
                        previewHtml = `
                        <div class="w-full h-16 flex items-center justify-center bg-gray-200 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file text-gray-600">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            </svg>
                        </div>
                    `;
                    }

                    $filesGrid.append(`
                    <div class="file-preview-item relative bg-white rounded-lg border border-gray-200 p-2">
                        <div class="file-preview">
                            ${previewHtml}
                        </div>
                        <div class="mt-1">
                            <p class="text-xs font-medium truncate" title="${media.name}">${media.name}</p>
                            <p class="text-xs text-gray-500">${humanFileSize(media.size || 0)}</p>
                        </div>
                        <button type="button" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-1 remove-single-file" data-file-index="${index}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                            </svg>
                        </button>
                    </div>
                `);
                });

                // Add event listeners for remove buttons
                $filesGrid.find('.remove-single-file').off('click').on('click', function() {
                    const fileIndex = parseInt($(this).data('file-index'));
                    removeSingleFile(fileIndex);
                });
            }

            function removeSingleFile(fileIndex) {
                if (fileIndex >= 0 && fileIndex < uploadedFiles.length) {
                    // Revoke object URL if it exists
                    const media = uploadedFiles[fileIndex];
                    if (media.previewUrl) {
                        try {
                            URL.revokeObjectURL(media.previewUrl);
                        } catch (e) {
                            /* ignore */
                        }
                    }

                    uploadedFiles.splice(fileIndex, 1);
                    renderUploadPreview();
                    updateUploadButtonState();
                }
            }

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
                        handleDroppedFiles(files);
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

            function handleDroppedFiles(files) {
                Array.from(files).forEach(file => {
                    validateAndProcessFile(file);
                });
            }

            function validateAndProcessFile(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let previewUrl;
                    if (file.type && file.type.startsWith('image/')) {
                        previewUrl = e.target.result; // base64 data URL for image
                    } else {
                        // create object URL for non-image (video/document)
                        previewUrl = URL.createObjectURL(file);
                    }

                    const media = {
                        id: null,
                        url: previewUrl,
                        name: file.name,
                        size: file.size,
                        file: file,
                        type: 'upload',
                        mime_type: file.type,
                        // store previewUrl so we can revoke it later if needed
                        previewUrl: (file.type && file.type.startsWith('image/')) ? null : previewUrl
                    };

                    uploadedFiles.push(media);
                    renderUploadPreview();
                    updateUploadButtonState();
                };
                // read as data URL (works for images; for others we still create objectURL above)
                reader.readAsDataURL(file);
            }

            function clearUploadPreview() {
                // revoke any object URLs created
                uploadedFiles.forEach(m => {
                    if (m.previewUrl) {
                        try {
                            URL.revokeObjectURL(m.previewUrl);
                        } catch (e) {
                            /* ignore */
                        }
                    }
                });
                uploadedFiles = [];
                renderUploadPreview();
                updateUploadButtonState();
                $('#modal-logo-upload').val('');
            }

            function updateUploadButtonState() {
                const $uploadButton = $('#upload-to-library');
                if (uploadedFiles.length > 0 && !isUploading) {
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
                if (uploadedFiles.length === 0 || isUploading) {
                    return;
                }

                isUploading = true;
                updateUploadButtonState();

                $('#upload-progress-container').removeClass('hidden');
                $('#upload-status').removeClass('hidden').text('Uploading...');

                const formData = new FormData();
                uploadedFiles.forEach(fileObj => {
                    formData.append('files[]', fileObj.file);
                });

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

                            // Add the new media to library and mark them selected in modal
                            data.items.forEach(newMedia => {
                                mediaLibraryItems.unshift(newMedia);
                                // ensure modalSelectedMedia includes this
                                addMediaToModalSelection(newMedia.id);
                            });

                            // Clear local preview (also revokes blob URLs)
                            clearUploadPreview();

                            // Switch to library tab and render
                            switchTab('library');
                            renderMediaLibrary(mediaLibraryItems);

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
            function loadMediaLibrary(search = '', loadMore = false) {
                if (isLoadingMore && loadMore) return;

                const $mediaContent = $('#media-library-content');

                if (!loadMore) {
                    $mediaContent.html(`
                    <div class="text-center py-12">
                        <i class="fas fa-spinner fa-spin text-blue-500 text-2xl"></i>
                        <p class="mt-2 text-gray-600">Loading media library...</p>
                    </div>
                `);
                    currentPage = 1;
                    mediaLibraryItems = [];
                    hasMorePages = true;
                    currentSearchTerm = search;
                } else {
                    isLoadingMore = true;
                    // Show loading indicator at the bottom
                    if ($('#load-more-media').length) {
                        $('#load-more-media').prop('disabled', true).html(`
                        <i class="fas fa-spinner fa-spin mr-2"></i> Loading...
                    `);
                    }
                }

                // Use the correct page number - if loading more, use currentPage + 1
                const pageToLoad = loadMore ? currentPage + 1 : 1;

                let url = '{{ route('admin.media.ajax.all') }}?perPage=50&page=' + pageToLoad;
                if (search) {
                    url += `&search=${encodeURIComponent(search)}`;
                }

                $.ajax({
                    url: url,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        if (data.data && data.data.length > 0) {
                            if (loadMore) {
                                // Append to existing items
                                mediaLibraryItems = [...mediaLibraryItems, ...data.data];
                            } else {
                                // Replace with new items
                                mediaLibraryItems = data.data;
                            }

                            // Update pagination info from response
                            currentPage = data.current_page || pageToLoad;
                            lastPage = data.last_page || 1;
                            hasMorePages = data.current_page < data.last_page;

                            if (loadMore) {
                                renderMediaLibrary(data.data,
                                    true); // Only pass new items when loading more
                            } else {
                                renderMediaLibrary(mediaLibraryItems, false);
                            }
                            updateLoadMoreButton();

                        } else {
                            if (!loadMore) {
                                mediaLibraryItems = [];
                                showNoMediaMessage();
                            }
                            hasMorePages = false;
                            updateLoadMoreButton();
                        }

                        isLoadingMore = false;
                    },
                    error: function(error) {
                        console.error('Error loading media library:', error);
                        if (!loadMore) {
                            showErrorLoadingMedia();
                        }
                        isLoadingMore = false;
                        updateLoadMoreButton();
                    }
                });
            }

            function renderMediaLibrary(mediaItems, append = false) {
                const $mediaContent = $('#media-library-content');

                let html = '';

                if (!append) {
                    html =
                        '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4" id="media-grid">';
                }

                // Just render all mediaItems passed to the function
                $.each(mediaItems, function(index, media) {
                    let previewHtml = '';
                    const fileExtension = (media.original_name || media.name || '').split('.').pop()
                        .toLowerCase();
                    const isSelected = modalSelectedMedia.some(item => item.id === media.id);

                    if (media.mime_type && media.mime_type.startsWith('image/')) {
                        previewHtml =
                            `<img src="${media.url}" alt="${media.original_name || media.name}" class="w-full h-24 object-scale-down">`;
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
            <div class="media-item bg-gray-100 rounded-lg overflow-hidden cursor-pointer transition-all hover:shadow-md ${isSelected ? 'selected' : ''}"
                data-media-id="${media.id}">
                <div class="checkbox-container">
                    <input type="checkbox" class="media-checkbox" data-media-id="${media.id}" ${isSelected ? 'checked' : ''}>
                </div>
                ${previewHtml}
                <div class="p-2">
                    <p class="text-xs text-center font-medium truncate">${media.original_name || media.name}</p>
                </div>
            </div>
        `;
                });

                if (!append) {
                    html += '</div>';
                    $mediaContent.html(html);
                } else {
                    $mediaContent.find('#media-grid').append(html);
                }

                // Add click event listeners to NEW media items only when appending
                const newItems = append ? $mediaContent.find('.media-item').slice(-mediaItems.length) :
                    $mediaContent.find('.media-item');

                newItems.off('click').on('click', function(e) {
                    if ($(e.target).is('input[type="checkbox"]')) {
                        return;
                    }
                    const mediaId = parseInt($(this).data('media-id'));
                    toggleMediaSelection(mediaId);
                });

                // Checkbox change event for new items
                newItems.find('.media-checkbox').off('change').on('change', function() {
                    const mediaId = parseInt($(this).data('media-id'));
                    const isChecked = $(this).is(':checked');

                    if (isChecked) {
                        addMediaToModalSelection(mediaId);
                    } else {
                        removeMediaFromModalSelection(mediaId);
                    }
                });
            }

            function updateLoadMoreButton() {
                let $loadMoreBtn = $('#load-more-media');
                const $mediaContent = $('#media-library-content');

                if (hasMorePages && mediaLibraryItems.length > 0) {
                    if ($loadMoreBtn.length === 0) {
                        $mediaContent.after(`
                        <div class="text-center mt-6">
                            <button id="load-more-media" class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                                <i class="fas fa-plus mr-2"></i> Load More Media
                            </button>
                        </div>
                    `);

                        $('#load-more-media').on('click', function() {
                            loadMediaLibrary(currentSearchTerm, true);
                        });
                    } else {
                        $loadMoreBtn.prop('disabled', false).html(`
                        <i class="fas fa-plus mr-2"></i> Load More Media
                    `);
                    }
                } else {
                    $loadMoreBtn.remove();

                    // Show "No more media" message if we have some items but no more pages
                    if (mediaLibraryItems.length > 0 && !hasMorePages) {
                        $mediaContent.after(`
                        <div class="text-center mt-4 py-4 text-gray-500">
                            <p>No more media to load</p>
                        </div>
                    `);
                    }
                }
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
                    <button onclick="loadMediaLibrary()" class="mt-4 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                        Retry
                    </button>
                </div>
            `);
            }

            function toggleMediaSelection(mediaId) {
                const media = mediaLibraryItems.find(item => item.id === mediaId);
                if (!media) return;

                const index = modalSelectedMedia.findIndex(item => item.id === mediaId);
                const $mediaItem = $(`.media-item[data-media-id="${mediaId}"]`);
                const $checkbox = $mediaItem.find('.media-checkbox');

                if (index === -1) {
                    modalSelectedMedia.push(media);
                    $mediaItem.addClass('selected');
                    $checkbox.prop('checked', true);
                } else {
                    modalSelectedMedia.splice(index, 1);
                    $mediaItem.removeClass('selected');
                    $checkbox.prop('checked', false);
                }
            }

            function addMediaToModalSelection(mediaId) {
                const media = mediaLibraryItems.find(item => item.id === mediaId);
                if (media && !modalSelectedMedia.some(item => item.id === mediaId)) {
                    modalSelectedMedia.push(media);
                    $(`.media-item[data-media-id="${mediaId}"]`).addClass('selected');
                    $(`.media-item[data-media-id="${mediaId}"]`).find('.media-checkbox').prop('checked', true);
                }
            }

            function removeMediaFromModalSelection(mediaId) {
                const index = modalSelectedMedia.findIndex(item => item.id === mediaId);
                if (index !== -1) {
                    modalSelectedMedia.splice(index, 1);
                    $(`.media-item[data-media-id="${mediaId}"]`).removeClass('selected');
                    $(`.media-item[data-media-id="${mediaId}"]`).find('.media-checkbox').prop('checked', false);
                }
            }

            // ========== GENERAL MODAL FUNCTIONS ==========
            function switchTab(tab) {
                currentTab = tab;

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

                    // Always load library when switching to library tab
                    // Reset pagination when switching to library tab
                    if (mediaLibraryItems.length === 0) {
                        loadMediaLibrary();
                    } else {
                        // If we already have media items, ensure load more button is properly set up
                        updateLoadMoreButton();
                    }
                }
            }

            function openMediaLibrary() {
                $('#media-library-modal').removeClass('hidden');
                switchTab('upload');
                setupDragAndDrop();

                // Pre-load the media library in the background
                if (mediaLibraryItems.length === 0) {
                    loadMediaLibrary();
                }
            }

            function closeMediaLibrary() {
                $('#media-library-modal').addClass('hidden');
                clearUploadPreview();
                // Reset modal selections when closing
                modalSelectedMedia = [];
            }

            function confirmMediaSelection() {
                selectedMediaItems = selectedMediaItems.filter(item => {
                    return !mediaLibraryItems.some(lib => lib.id === item.id);
                });

                // Add current modal selections
                selectedMediaItems = selectedMediaItems.concat(modalSelectedMedia);

                renderSelectedImages();
                updateMediaIdsInput();
                closeMediaLibrary();
            }

            // ========== EVENT LISTENERS ==========
            $(document).on('click', '.remove-media', function() {
                const mediaId = $(this).data('media-id');
                removeMediaFromSelection(mediaId);
            });

            $('#open-media-library').on('click', openMediaLibrary);
            $('#close-media-library, #cancel-upload, #cancel-media-selection').on('click', closeMediaLibrary);
            $('#upload-tab').on('click', function() {
                switchTab('upload');
            });
            $('#library-tab').on('click', function() {
                switchTab('library');
            });

            $('#modal-logo-upload').on('change', function() {
                if (this.files && this.files.length > 0) {
                    Array.from(this.files).forEach(file => {
                        validateAndProcessFile(file);
                    });
                }
            });

            $('#clear-upload-preview').on('click', clearUploadPreview);
            $('#upload-to-library').on('click', uploadToLibrary);
            $('#confirm-selection-multiple').on('click', confirmMediaSelection);

            // Search functionality
            $('#modal-media-search').on('keyup', function() {
                const searchTerm = $(this).val();
                // Add a small delay to avoid too many requests
                clearTimeout($(this).data('timeout'));
                $(this).data('timeout', setTimeout(() => {
                    loadMediaLibrary(searchTerm);
                }, 500));
            });

            // Form submission
            $('#assign-images-form').on('submit', function(e) {
                e.preventDefault();

                if (selectedMediaItems.length === 0) {
                    alert('Please select at least one image');
                    return;
                }

                // Show loading state
                $('button[type="submit"]').prop('disabled', true).text('Saving...');

                // Get media IDs as array
                const mediaIds = selectedMediaItems.map(item => item.id);

                // Create FormData to properly send array
                const formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());

                // Append each media ID as array element
                mediaIds.forEach(id => {
                    formData.append('media_ids[]', id);
                });

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false, // Important for FormData
                    contentType: false, // Important for FormData
                    success: function(response) {
                        if (response.success) {
                            // Store the success message in localStorage
                            localStorage.setItem('toastr_success', response.message) ||
                                '{{ route('admin.event.all') }}';

                            // Redirect to index page
                            window.location.href = response.redirect;
                        } else {
                            alert('Error saving images: ' + (response.message ||
                                'Unknown error'));
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error saving images. Please try again.';

                        // Try to get more specific error message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                errorMessage = response.message || errorMessage;
                            } catch (e) {
                                // Not JSON, use default message
                            }
                        }

                        alert(errorMessage);
                    },
                    complete: function() {
                        $('button[type="submit"]').prop('disabled', false).text('Save Images');
                    }
                });
            });

            // Initial load
            loadEventImages();
        });
    </script>
@endpush
