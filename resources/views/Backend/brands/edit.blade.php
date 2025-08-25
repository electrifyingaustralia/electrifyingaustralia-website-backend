@extends('Backend.layouts.app')
@section('contents')
<div class="flex-1 p-6">
    <div class="max-w-5xl mx-auto">
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
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Edit Brand</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">{{$brand->name}}</span>
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
            <form id="brand-form" action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <!-- Brand Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Brand Name <span class="text-red-600">*</span></label>
                        <input
                            type="text" id="name" name="name" value="{{ old('name', $brand->name) }}" required
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
                            type="url" id="link" name="link" value="{{ old('link', $brand->link) }}"
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
                                @if($brand->logo)
                                    <img src="{{ $brand->logo->url }}" alt="{{ $brand->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <div class="text-center text-gray-400">
                                        <i class="fas fa-image text-2xl mb-2"></i>
                                        <p class="text-xs">No logo selected</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Logo Actions -->
                            <div class="flex flex-col justify-center gap-2">
                                <button type="button" onclick="openMediaLibrary()" class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg">
                                    <div class="flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload-icon lucide-upload"><path d="M12 3v12"/><path d="m17 8-5-5-5 5"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/></svg>
                                        <span>Change Logo</span>
                                    </div>
                                </button>

                                <input type="hidden" id="selected-media-id" name="logo_id" value="{{ old('logo_id', $brand->logo_id) }}">
                            </div>
                        </div>

                        <!-- Selected Logo Info -->
                        <div id="selected-logo-info" class="mt-3 p-3 bg-gray-50 rounded-lg {{ $brand->logo ? '' : 'hidden' }}">
                            @if($brand->logo)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img id="selected-logo-preview" src="{{ $brand->logo->url }}" alt="Selected logo" class="w-12 h-12 object-cover rounded">
                                    <div>
                                        <p id="selected-logo-name" class="text-sm font-medium">{{ $brand->logo->original_name }}</p>
                                        <p id="selected-logo-size" class="text-xs text-gray-500">{{ ($brand->logo->file_size) }}</p>
                                    </div>
                                </div>
                                <button type="button" onclick="removeSelectedLogo()" class="text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.brands.all') }}" class="!bg-gray-600 hover:!bg-gray-700 text-white px-6 py-2 rounded-lg">
                        <div class="flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            <span>Cancel</span>
                        </div>
                    </a>
                    <button type="submit" class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                        <div class="flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save-icon lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                            <span>Update Brand</span>
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
            <button onclick="closeMediaLibrary()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Tabs -->
        <div class="border-b">
            <div class="flex">
                <button id="upload-tab" class="px-6 py-3 border-b-2 border-teal-600 text-teal-600 font-medium" onclick="switchTab('upload')">
                    <i class="fas fa-upload mr-2"></i> Upload New
                </button>
                <button id="library-tab" class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700" onclick="switchTab('library')">
                    <i class="fas fa-image mr-2"></i> Media Library
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="flex-1 overflow-auto">
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
                        <input type="file" id="modal-logo-upload" accept="image/*" class="hidden" onchange="handleModalFileUpload(this)">
                        <label for="modal-logo-upload" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                            <i class="fas fa-upload mr-2"></i> Browse Files
                        </label>
                        <p class="text-xs text-gray-500 mt-3">Supported formats: JPG, PNG, GIF, SVG • Max size: 2MB</p>
                    </div>

                    <div id="upload-preview" class="upload-content hidden">
                        <div class="flex flex-col items-center">
                            <img id="preview-image" src="" alt="Preview" class="w-32 h-32 object-contain mb-4 rounded-lg">
                            <p id="preview-filename" class="text-sm font-medium text-gray-700 mb-2"></p>
                            <p id="preview-size" class="text-xs text-gray-500 mb-4"></p>
                            <button onclick="clearUploadPreview()" class="!text-red-600 hover:!text-red-800 text-sm">
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

        <div class="flex justify-end p-6 border-t bg-gray-50 gap-x-2">
            <button onclick="closeMediaLibrary()" class="!bg-gray-600 hover:!bg-gray-700 text-white px-4 py-2 rounded-lg mr-3">
                Cancel
            </button>
            <button id="confirm-selection"
                    onclick="confirmMediaSelection()"
                    class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg"
                    disabled>
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
    min-height: 200px;
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
let selectedMedia = null;
let currentTab = 'upload';
let mediaLibraryItems = [];

// Initialize with existing logo data if available
@if($brand->logo)
selectedMedia = {
    id: {{ $brand->logo_id }},
    url: '{{ $brand->logo->url }}',
    name: '{{ $brand->logo->original_name }}',
    size: {{ $brand->logo->file_size }},
    file: null,
    type: 'library'
};
@endif

// ========== UPLOAD TAB FUNCTIONS ==========
function setupDragAndDrop() {
    const uploadArea = document.getElementById('upload-area');

    const preventDefaults = (e) => {
        e.preventDefault();
        e.stopPropagation();
    };

    const highlight = () => {
        uploadArea.classList.add('bg-blue-50', 'border-blue-400');
    };

    const unhighlight = () => {
        uploadArea.classList.remove('bg-blue-50', 'border-blue-400');
    };

    const handleDrop = (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            handleDroppedFile(files[0]);
        }
        unhighlight();
    };

    // Remove existing listeners
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.removeEventListener(eventName, preventDefaults);
    });

    // Add new listeners
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults);
    });

    uploadArea.addEventListener('dragenter', highlight);
    uploadArea.addEventListener('dragover', highlight);
    uploadArea.addEventListener('dragleave', unhighlight);
    uploadArea.addEventListener('drop', handleDrop);
}

function handleDroppedFile(file) {
    validateAndProcessFile(file);
}

function handleModalFileUpload(input) {
    if (input.files && input.files[0]) {
        validateAndProcessFile(input.files[0]);
    }
}

function validateAndProcessFile(file) {
    if (!file.type.startsWith('image/')) {
        alert('Please select an image file (JPG, PNG, GIF, SVG)');
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        alert('File size must be less than 2MB');
        return;
    }

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

        updateConfirmButtonState();
    };
    reader.readAsDataURL(file);
}

function showUploadPreview(file, dataUrl) {
    const uploadDefault = document.getElementById('upload-default');
    const uploadPreview = document.getElementById('upload-preview');
    const previewImage = document.getElementById('preview-image');
    const previewFilename = document.getElementById('preview-filename');
    const previewSize = document.getElementById('preview-size');

    previewImage.src = dataUrl;
    previewFilename.textContent = file.name;
    previewSize.textContent = formatFileSize(file.size);

    uploadDefault.classList.add('hidden');
    uploadPreview.classList.remove('hidden');
}

function clearUploadPreview() {
    const uploadDefault = document.getElementById('upload-default');
    const uploadPreview = document.getElementById('upload-preview');

    uploadPreview.classList.add('hidden');
    uploadDefault.classList.remove('hidden');

    document.getElementById('modal-logo-upload').value = '';

    if (selectedMedia?.type === 'upload') {
        selectedMedia = null;
        updateConfirmButtonState();
    }
}

// ========== LIBRARY TAB FUNCTIONS ==========
function loadMediaLibrary() {
    const mediaContent = document.getElementById('media-library-content');
    mediaContent.innerHTML = `
        <div class="text-center py-12">
            <i class="fas fa-spinner fa-spin text-blue-500 text-2xl"></i>
            <p class="mt-2 text-gray-600">Loading media library...</p>
        </div>
    `;

    fetch('{{ route("admin.media.ajax.all") }}?perPage=24&type=image', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.data && data.data.length > 0) {
            mediaLibraryItems = data.data;
            renderMediaLibrary(data.data);
        } else {
            showNoMediaMessage();
        }
    })
    .catch(error => {
        console.error('Error loading media library:', error);
        showErrorLoadingMedia();
    });
}

function renderMediaLibrary(mediaItems) {
    const mediaContent = document.getElementById('media-library-content');

    let html = '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">';

    mediaItems.forEach((media, index) => {
        const isSelected = selectedMedia && selectedMedia.id === media.id;
        html += `
            <div class="media-item bg-gray-100 rounded-lg overflow-hidden cursor-pointer transition-all hover:shadow-md ${isSelected ? 'selected' : ''}"
                 data-index="${index}">
                <img src="${media.url}" alt="${media.original_name}" class="w-full h-24 object-cover">
                <div class="p-2">
                    <p class="text-xs font-medium truncate">${media.original_name}</p>
                </div>
            </div>
        `;
    });

    html += '</div>';
    mediaContent.innerHTML = html;

    // Add click event listeners
    mediaContent.querySelectorAll('.media-item').forEach(item => {
        item.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            selectMediaFromLibrary(index);
        });
    });
}

function selectMediaFromLibrary(index) {
    const media = mediaLibraryItems[index];

    // Remove previous selection
    document.querySelectorAll('.media-item').forEach(item => {
        item.classList.remove('selected');
    });

    // Add selection to current item
    const selectedItem = document.querySelector(`.media-item[data-index="${index}"]`);
    if (selectedItem) {
        selectedItem.classList.add('selected');
    }

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
    const mediaContent = document.getElementById('media-library-content');
    mediaContent.innerHTML = `
        <div class="text-center py-12">
            <i class="fas fa-folder-open text-gray-400 text-4xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-700">No media files found</h3>
            <p class="text-gray-500 mt-2">Upload images to use as logos</p>
        </div>
    `;
}

function showErrorLoadingMedia() {
    const mediaContent = document.getElementById('media-library-content');
    mediaContent.innerHTML = `
        <div class="text-center py-12">
            <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-700">Error loading media</h3>
            <p class="text-gray-500 mt-2">Please try again</p>
        </div>
    `;
}

// ========== GENERAL MODAL FUNCTIONS ==========
function updateConfirmButtonState() {
    const confirmButton = document.getElementById('confirm-selection');
    if (selectedMedia) {
        confirmButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
        confirmButton.classList.add('bg-teal-600', 'hover:bg-teal-700');
        confirmButton.disabled = false;
    } else {
        confirmButton.classList.remove('bg-teal-600', 'hover:bg-teal-700');
        confirmButton.classList.add('bg-gray-400', 'cursor-not-allowed');
        confirmButton.disabled = true;
    }
}

function switchTab(tab) {
    currentTab = tab;

    // Update tab buttons
    document.getElementById('upload-tab').classList.remove('tab-active');
    document.getElementById('library-tab').classList.remove('tab-active');
    document.getElementById('upload-tab-content').classList.add('hidden');
    document.getElementById('library-tab-content').classList.add('hidden');

    if (tab === 'upload') {
        document.getElementById('upload-tab').classList.add('tab-active');
        document.getElementById('upload-tab-content').classList.remove('hidden');
    } else {
        document.getElementById('library-tab').classList.add('tab-active');
        document.getElementById('library-tab-content').classList.remove('hidden');

        if (document.querySelectorAll('.media-item').length === 0) {
            loadMediaLibrary();
        }
    }
    updateConfirmButtonState();
}

function openMediaLibrary() {
    document.getElementById('media-library-modal').classList.remove('hidden');
    switchTab('upload');
    setupDragAndDrop();

    updateConfirmButtonState();
}

function closeMediaLibrary() {
    document.getElementById('media-library-modal').classList.add('hidden');
    updateConfirmButtonState();
    clearUploadPreview();
}

function confirmMediaSelection() {
    if (!selectedMedia) {
        alert('Please select a logo first');
        return;
    }

    if (selectedMedia.type === 'upload') {
        uploadNewLogo(selectedMedia.file);
    } else if (selectedMedia.type === 'library') {
        applySelectedMedia();
    }
}

function uploadNewLogo(file) {
    const formData = new FormData();
    formData.append('files[]', file);

    fetch('{{ route("admin.media.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.items && data.items.length > 0) {
            selectedMedia.id = data.items[0].id;
            applySelectedMedia();
        } else {
            alert('Error uploading logo');
        }
    })
    .catch(error => {
        console.error('Error uploading logo:', error);
        alert('Error uploading logo');
    });
}

function applySelectedMedia() {
    document.getElementById('selected-media-id').value = selectedMedia.id;

    const preview = document.getElementById('logo-preview');
    preview.innerHTML = `<img src="${selectedMedia.url}" alt="${selectedMedia.name}" class="w-full h-full object-cover">`;

    const infoDiv = document.getElementById('selected-logo-info');
    document.getElementById('selected-logo-preview').src = selectedMedia.url;
    document.getElementById('selected-logo-name').textContent = selectedMedia.name;
    document.getElementById('selected-logo-size').textContent = formatFileSize(selectedMedia.size);
    infoDiv.classList.remove('hidden');

    closeMediaLibrary();
}

function removeSelectedLogo() {
    const preview = document.getElementById('logo-preview');
    preview.innerHTML = `
        <div class="text-center text-gray-400">
            <i class="fas fa-image text-2xl mb-2"></i>
            <p class="text-xs">No logo selected</p>
        </div>
    `;

    document.getElementById('selected-logo-info').classList.add('hidden');
    document.getElementById('selected-media-id').value = '';
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

// Form Submission
document.getElementById('brand-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect || '{{ route('admin.brands.all') }}';
        } else {
            if (data.errors) {
                let errorMessage = 'Please fix the following errors:\n';
                for (const [field, errors] of Object.entries(data.errors)) {
                    errorMessage += `- ${errors.join(', ')}\n`;
                }
                alert(errorMessage);
            } else {
                alert(data.message || 'Error updating brand');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating brand');
    });
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateConfirmButtonState();
});
</script>
@endpush
