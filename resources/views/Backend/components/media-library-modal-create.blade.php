<!-- Media Library Modal -->
<div id="media-library-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-lg w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-lg font-medium">Upload or Select Media</h3>
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
        <div class="flex-1 overflow-auto min-h-[30rem]">
            <!-- Upload Tab -->
            <div id="upload-tab-content" class="p-6">
                <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center relative">
                    <div id="upload-default" class="upload-content">
                        <div class="mx-auto w-16 h-16 text-gray-400 mb-4">
                            <div class="mx-auto w-18 text-gray-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="m-auto text-center" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Drag & drop your media here or click to browse</p>
                        <input type="file" id="modal-logo-upload" class="hidden" accept="{{ $accept ?? '*' }}">
                        <label for="modal-logo-upload" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                            <i class="fas fa-upload mr-2"></i> Browse Files
                        </label>
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
                Select Media
            </button>
        </div>
    </div>
</div>

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
    const acceptTypes = '{{ $accept ?? "*" }}';

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
        // Check file type if specified
        if (acceptTypes !== '*' && !isFileTypeAccepted(file, acceptTypes)) {
            alert('File type not accepted. Please select a valid file.');
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

            updateUploadButtonState();
        };
        reader.readAsDataURL(file);
    }

    function isFileTypeAccepted(file, acceptPattern) {
        if (acceptPattern === '*') return true;

        const acceptedTypes = acceptPattern.split(',').map(type => type.trim());
        const fileExtension = file.name.split('.').pop().toLowerCase();

        return acceptedTypes.some(type => {
            if (type.startsWith('.')) {
                return type.substring(1).toLowerCase() === fileExtension;
            }

            // Handle MIME types (e.g., image/*, image/jpeg)
            if (type.includes('/')) {
                if (type.endsWith('/*')) {
                    const category = type.split('/')[0];
                    return file.type.startsWith(category);
                }
                return file.type === type;
            }

            return false;
        });
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
            url: '{{ route("admin.media.ajax.all") }}?perPage=15',
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
                <p class="text-gray-500 mt-2">Upload media to use</p>
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
});
</script>
@endpush
