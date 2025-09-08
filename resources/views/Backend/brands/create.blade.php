@extends('Backend.layouts.app')
@section('contents')
<div class="flex-1 p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Breadcrumb and navigation code remains the same -->
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
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Create New Brand</span>
                    </div>
                </li>
            </ol>
            <a href="{{ route('admin.brands.all') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                <div class="flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    <span>Back to Brands</span>
                </div>
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <form id="brand-form" action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <!-- Brand Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Brand Name <span class="text-red-600">*</span></label>
                        <input
                            type="text" id="name" name="name" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            placeholder="Enter brand name"
                        />
                        @error('name')
                            <p class="!text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Brand Link -->
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Website Link <span class="text-red-600">*</span></label>
                        <input
                            type="url" id="link" name="link"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            placeholder="https://example.com"
                        />
                        @error('link')
                            <p class="!text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Logo Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand Logo <span class="text-red-600">*</span></label>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <!-- Logo Preview -->
                            <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50" id="logo-preview">
                                <div class="text-center text-gray-400">
                                    <i class="fas fa-image text-2xl mb-2"></i>
                                    <p class="text-xs">No logo selected</p>
                                </div>
                            </div>

                            <!-- Logo Actions -->
                            <div class="flex flex-col justify-center gap-2">
                                <button type="button" id="open-media-library" class="!bg-[#006494] hover:!bg-[#003554] text-white px-4 py-2 rounded-lg">
                                    <div class="flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload-icon lucide-upload"><path d="M12 3v12"/><path d="m17 8-5-5-5 5"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/></svg>
                                        <span>Upload New Media</span>
                                    </div>
                                </button>

                                <input type="hidden" id="selected-media-id" name="logo_id">
                            </div>
                        </div>

                        <!-- Selected Logo Info -->
                        <div id="selected-logo-info" class="mt-3 p-3 bg-gray-50 rounded-lg hidden">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img id="selected-logo-preview" src="" alt="Selected logo" class="w-12 h-12 object-cover rounded">
                                    <div>
                                        <p id="selected-logo-name" class="text-sm font-medium"></p>
                                        <p id="selected-logo-size" class="text-xs text-gray-500"></p>
                                    </div>
                                </div>
                                <button type="button" id="remove-selected-logo" class="text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="submit" class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                        <div class="flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save-icon lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                            <span>Create Brand</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Media Library Modal -->
<div id="media-library-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-lg w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-lg font-medium">Upload or Select Logo</h3>
            <button id="close-media-library" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <!-- Tabs -->
        <div class="border-b">
            <div class="flex">
                <button id="upload-tab" class="px-6 py-3 border-b-2 border-teal-600 text-teal-600 font-medium">
                    <i class="fas fa-upload mr-2"></i> Upload New
                </button>
                <button id="library-tab" class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700">
                    <i class="fas fa-image mr-2"></i> Media Library
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="flex-1 overflow-auto min-h-[35rem]">
            <!-- Upload Tab -->
            <div id="upload-tab-content" class="p-6">
                <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center relative">
                    <div id="upload-default" class="upload-content">
                        <div class="mx-auto w-16 h-16 text-gray-400 mb-4">
                            <div class="mx-auto w-18 text-gray-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="m-auto text-center" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Drag & drop your logo here or click to browse</p>
                        <input type="file" id="modal-logo-upload" accept="image/*" class="hidden">
                        <label for="modal-logo-upload" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                            <i class="fas fa-upload mr-2"></i> Browse Files
                        </label>
                        {{-- <p class="text-xs text-gray-500 mt-3">Supported formats: JPG, PNG, GIF, SVG • Max size: 10MB</p> --}}
                    </div>

                    <div id="upload-preview" class="upload-content hidden">
                        <div class="flex flex-col items-center">
                            <img id="preview-image" src="" alt="Preview" class="w-32 h-32 object-contain mb-4 rounded-lg">
                            <p id="preview-filename" class="text-sm font-medium text-gray-700 mb-2"></p>
                            <p id="preview-size" class="text-xs text-gray-500 mb-4"></p>

                            <!-- Progress Bar -->
                            <div id="upload-progress-container" class="w-full bg-gray-200 rounded-full h-2.5 mb-4 hidden">
                                <div id="upload-progress-bar" class="bg-teal-600 h-2.5 rounded-full" style="width: 0%"></div>
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
            <button id="upload-to-library" class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg" disabled>
                Upload to Media Library
            </button>
        </div>

        <!-- Library Tab Buttons -->
        <div id="library-tab-buttons" class="flex justify-end p-6 border-t bg-gray-50 gap-x-2 hidden">
            <button id="cancel-media-selection" class="!bg-gray-600 hover:!bg-gray-700 text-white px-4 py-2 rounded-lg mr-3">
                Cancel
            </button>
            <button id="confirm-selection" class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg" disabled>
                Select Logo
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

        // Hide progress elements initially
        $('#upload-progress-container').addClass('hidden');
        $('#upload-status').addClass('hidden');

        $('#preview-image').attr('src', dataUrl);
        $('#preview-filename').text(file.name);
        $('#preview-size').text(formatFileSize(file.size));
    }

    function clearUploadPreview() {
        $('#upload-preview').addClass('hidden');
        $('#upload-default').removeClass('hidden');
        $('#modal-logo-upload').val('');

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
            url: '{{ route("admin.media.store") }}',
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
                    alert('Error uploading logo');
                }
                isUploading = false;
                updateUploadButtonState();
            },
            error: function(error) {
                console.error('Error uploading logo:', error);
                $('#upload-status').text('Upload failed!');
                alert('Error uploading logo');
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
            url: '{{ route("admin.media.ajax.all") }}?perPage=24&type=image',
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
            html += `
                <div class="media-item bg-gray-100 rounded-lg overflow-hidden cursor-pointer transition-all hover:shadow-md"
                     data-index="${index}">
                    <img src="${media.url}" alt="${media.original_name}" class="w-full h-24 object-scale-down">
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
                <p class="text-gray-500 mt-2">Upload images to use as logos</p>
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
            alert('Please select a logo first');
            return;
        }

        if (selectedMedia.type === 'library') {
            applySelectedMedia();
        }
    }

    function applySelectedMedia() {
        $('#selected-media-id').val(selectedMedia.id);

        $('#logo-preview').html(`<img src="${selectedMedia.url}" alt="${selectedMedia.name}" class="w-full h-full object-cover">`);

        $('#selected-logo-preview').attr('src', selectedMedia.url);
        $('#selected-logo-name').text(selectedMedia.name);
        $('#selected-logo-size').text(formatFileSize(selectedMedia.size));
        $('#selected-logo-info').removeClass('hidden');

        closeMediaLibrary();
    }

    function removeSelectedLogo() {
        $('#logo-preview').html(`
            <div class="text-center text-gray-400">
                <i class="fas fa-image text-2xl mb-2"></i>
                <p class="text-xs">No logo selected</p>
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

    // Event bindings
    $('#open-media-library').on('click', openMediaLibrary);
    $('#close-media-library, #cancel-upload, #cancel-media-selection').on('click', closeMediaLibrary);
    $('#upload-tab').on('click', function() { switchTab('upload'); });
    $('#library-tab').on('click', function() { switchTab('library'); });
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
    $('#brand-form').on('submit', function(e) {
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
                    localStorage.setItem('toastr_success', response.message) || '{{ route('admin.brands.all') }}';

                    // Redirect to index page
                    window.location.href = response.redirect;
                } else {
                    toastr.error(response.message || 'An error occurred');
                    $('button[type="submit"]').prop('disabled', false).text('Create Brand');
                }
            },
            error: function(xhr) {
                // Handle errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = 'Please fix the following errors:<br>';

                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMessage += '- ' + errors[field].join('<br>') + '<br>';
                        }
                    }

                    toastr.error(errorMessage);
                } else {
                    toastr.error('An error occurred. Please try again.');
                }

                $('button[type="submit"]').prop('disabled', false).text('Create Brand');
            }
        });
    });
});
</script>
@endpush
