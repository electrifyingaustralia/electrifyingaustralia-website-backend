@extends('backend.layouts.app')
@section('contents')
    <div class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Media Library</h1>

                <!-- Upload Button -->
                <label for="media-upload"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg cursor-pointer">
                    <div class="flex gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-upload-icon lucide-upload">
                            <path d="M12 3v12" />
                            <path d="m17 8-5-5-5 5" />
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        </svg>
                        <span>Upload Files</span>
                    </div>
                </label>
                <input type="file" id="media-upload" multiple class="hidden" accept="image/*,video/*,.pdf,.doc,.docx">
            </div>

            <!-- Filters and Search -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-auto">
                        <input type="text" id="search-input" placeholder="Search by name..."
                            class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <button id="search-btn" class="flex items-center !bg-black text-white px-4 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-1" width="20" height="20"
                            viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34" />
                            <circle cx="11" cy="11" r="8" />
                        </svg>
                        <span>Search</span>
                    </button>
                    <div class="min-w-1/5">
                        <select id="type-filter" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="">All Media Types</option>
                            <option value="image">Images</option>
                            <option value="video">Videos</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Media Grid -->
            <div class="bg-white p-4 rounded-lg shadow">
                <div id="media-grid" class="grid !grid-cols-2 sm:!grid-cols-3 md:!grid-cols-4 lg:!grid-cols-6 !gap-4">
                    <!-- Media items will be loaded here via AJAX -->
                </div>

                <!-- Loading indicator -->
                <div id="loading" class="text-center py-8 hidden">
                    <svg class="animate-spin h-8 w-8 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <p class="mt-2 text-gray-600">Loading media...</p>
                </div>

                <!-- Empty state -->
                <div id="empty-state" class="flex flex-col items-center text-center py-12 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <div class="pt-2">
                        <h3 class="text-lg font-medium text-gray-700">No media files found</h3>
                        <p class="text-gray-500 mt-2">Upload your first file to get started</p>
                    </div>
                </div>
            </div>
            <!-- Pagination Container -->
            <div id="pagination-container" class="mt-6">
                <!-- Pagination will be loaded here via AJAX -->
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this file? This action cannot be undone.</p>
            <div class="flex justify-end !space-x-3">
                <button id="cancel-delete"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                <button id="confirm-delete"
                    class="px-4 py-2 !bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;
            let currentFilters = {
                type: '',
                search: ''
            };
            let mediaToDelete = null;

            // Elements
            const mediaGrid = document.getElementById('media-grid');
            const paginationContainer = document.getElementById('pagination-container');
            const loading = document.getElementById('loading');
            const emptyState = document.getElementById('empty-state');
            const typeFilter = document.getElementById('type-filter');
            const searchInput = document.getElementById('search-input');
            const searchBtn = document.getElementById('search-btn');
            const uploadInput = document.getElementById('media-upload');
            const deleteModal = document.getElementById('delete-modal');
            const cancelDeleteBtn = document.getElementById('cancel-delete');
            const confirmDeleteBtn = document.getElementById('confirm-delete');

            // Load initial media
            loadMedia();

            // Event listeners
            typeFilter.addEventListener('change', function() {
                currentFilters.type = this.value;
                currentPage = 1;
                loadMedia();
            });

            searchBtn.addEventListener('click', function() {
                currentFilters.search = searchInput.value;
                currentPage = 1;
                loadMedia();
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    currentFilters.search = this.value;
                    currentPage = 1;
                    loadMedia();
                }
            });

            uploadInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    uploadFiles(this.files);
                }
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });

            confirmDeleteBtn.addEventListener('click', function() {
                if (mediaToDelete) {
                    deleteMedia(mediaToDelete);
                }
            });

            // Functions
            function loadMedia() {
                loading.classList.remove('hidden');
                mediaGrid.innerHTML = '';
                paginationContainer.innerHTML = '';
                emptyState.classList.add('hidden');

                const url = new URL('{{ route('admin.media.ajax.all') }}');
                url.searchParams.append('perPage', 24);
                url.searchParams.append('page', currentPage);

                if (currentFilters.type) {
                    url.searchParams.append('type', currentFilters.type);
                }

                if (currentFilters.search) {
                    url.searchParams.append('search', currentFilters.search);
                }

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        loading.classList.add('hidden');

                        if (data.data && data.data.length > 0) {
                            renderMedia(data.data);
                            renderPagination(data);
                        } else {
                            emptyState.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        loading.classList.add('hidden');
                        console.error('Error loading media:', error);
                    });
            }

            function renderMedia(mediaItems) {
                mediaGrid.innerHTML = '';

                mediaItems.forEach(media => {
                    const mediaCard = document.createElement('div');
                    mediaCard.className = 'bg-gray-100 rounded-lg overflow-hidden group relative';

                    let mediaContent = '';

                    if (media.is_image) {
                        mediaContent = `
                        <img src="${media.url}" alt="${media.original_name}" class="w-full h-40 object-scale-down">
                    `;
                    } else if (media.is_video) {
                        mediaContent = `
                        <div class="w-full h-40 bg-gray-800 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <path d="m10 7 5 3-5 3Z"/>
                                <rect width="16" height="14" x="4" y="3" rx="2"/>
                            </svg>
                        </div>
                    `;
                    } else {
                        // Determine file type icon based on mime type
                        let fileIcon = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                        </svg>
                    `;

                        if (media.mime_type === 'application/pdf') {
                            fileIcon = `
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                <path d="M8 13h1"/>
                                <path d="M8 17h1"/>
                                <path d="M12 13h3"/>
                                <path d="M12 17h1"/>
                            </svg>
                        `;
                        } else if (media.mime_type.includes('word') || media.mime_type.includes(
                            'document')) {
                            fileIcon = `
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                <path d="M8 13h4"/>
                                <path d="M8 17h6"/>
                            </svg>
                        `;
                        }

                        mediaContent = `
                        <div class="w-full h-40 bg-gray-800 flex items-center justify-center">
                            ${fileIcon}
                        </div>
                    `;
                    }

                    mediaCard.innerHTML = `
                    ${mediaContent}
                    <!-- View button at top left corner -->
                    <button class="view-media absolute top-2 left-2 p-2 bg-white rounded-full text-gray-800 hover:bg-gray-100 shadow-md transition-colors" data-url="${media.url}" title="View file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>

                    <!-- Delete button at top right corner -->
                    <button class="delete-media absolute top-2 right-2 p-2 !bg-red-600 rounded-full text-white hover:bg-red-700 shadow-md transition-colors" data-id="${media.id}" title="Delete file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                            <path d="M3 6h18"/>
                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>

                    <div class="p-2">
                        <p class="text-sm font-medium truncate">${media.original_name}</p>
                        <p class="text-xs text-gray-500">${formatFileSize(media.file_size)}</p>
                    </div>
                `;

                    mediaGrid.appendChild(mediaCard);
                });

                // Add event listeners to delete buttons
                document.querySelectorAll('.delete-media').forEach(button => {
                    button.addEventListener('click', function() {
                        mediaToDelete = this.getAttribute('data-id');
                        deleteModal.classList.remove('hidden');
                    });
                });

                // Add event listeners to view buttons
                document.querySelectorAll('.view-media').forEach(button => {
                    button.addEventListener('click', function() {
                        const url = this.getAttribute('data-url');
                        window.open(url, '_blank');
                    });
                });
            }

            function renderPagination(data) {
                paginationContainer.innerHTML = '';

                if (data.last_page <= 1) return;

                // Create pagination HTML similar to our common component
                const paginationHTML = `
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="flex items-center justify-between flex-col sm:flex-row gap-4">
                        <div class="text-sm text-gray-700">
                            Showing ${data.from} to ${data.to} of ${data.total} results
                        </div>
                        <div class="flex space-x-2">
                            ${data.current_page > 1 ?
                                `<button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors pagination-link" data-page="${data.current_page - 1}">
                                        Previous
                                    </button>` :
                                `<span class="px-3 py-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed text-sm">
                                        Previous
                                    </span>`
                            }

                            ${generatePageNumbers(data)}

                            ${data.current_page < data.last_page ?
                                `<button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors pagination-link" data-page="${data.current_page + 1}">
                                        Next
                                    </button>` :
                                `<span class="px-3 py-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed text-sm">
                                        Next
                                    </span>`
                            }
                        </div>
                    </div>
                </div>
            `;

                paginationContainer.innerHTML = paginationHTML;

                // Add event listeners to pagination buttons
                document.querySelectorAll('.pagination-link').forEach(button => {
                    button.addEventListener('click', function() {
                        currentPage = parseInt(this.getAttribute('data-page'));
                        loadMedia();
                    });
                });
            }

            function generatePageNumbers(data) {
                let html = '';
                const currentPage = data.current_page;
                const lastPage = data.last_page;

                // Show limited pages with ellipsis for better UX
                let start = Math.max(1, currentPage - 2);
                let end = Math.min(lastPage, currentPage + 2);

                if (currentPage - 1 < 2) {
                    end = Math.min(lastPage, end + (2 - (currentPage - 1)));
                }

                if (lastPage - currentPage < 2) {
                    start = Math.max(1, start - (2 - (lastPage - currentPage)));
                }

                // First page and ellipsis if needed
                if (start > 1) {
                    html += `
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors pagination-link" data-page="1">
                        1
                    </button>
                `;
                    if (start > 2) {
                        html += `<span class="px-3 py-1 text-gray-500">...</span>`;
                    }
                }

                // Page numbers
                for (let i = start; i <= end; i++) {
                    if (i === currentPage) {
                        html += `
                        <span class="px-3 py-1 border border-teal-600 bg-teal-600 text-white rounded-lg text-sm">
                            ${i}
                        </span>
                    `;
                    } else {
                        html += `
                        <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors pagination-link" data-page="${i}">
                            ${i}
                        </button>
                    `;
                    }
                }

                // Last page and ellipsis if needed
                if (end < lastPage) {
                    if (end < lastPage - 1) {
                        html += `<span class="px-3 py-1 text-gray-500">...</span>`;
                    }
                    html += `
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors pagination-link" data-page="${lastPage}">
                        ${lastPage}
                    </button>
                `;
                }

                return html;
            }

            function uploadFiles(files) {
                const formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('files[]', files[i]);
                }

                loading.classList.remove('hidden');

                fetch('{{ route('admin.media.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        loading.classList.add('hidden');
                        uploadInput.value = '';

                        if (data.success) {
                            loadMedia(); // Reload the media list
                        } else {
                            alert('Error uploading files');
                        }
                    })
                    .catch(error => {
                        loading.classList.add('hidden');
                        console.error('Error uploading files:', error);
                        alert('Error uploading files');
                    });
            }

            function deleteMedia(id) {
                fetch(`/admin/media/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        deleteModal.classList.add('hidden');

                        if (data.success) {
                            loadMedia(); // Reload the media list
                        } else {
                            alert('Error deleting file');
                        }
                    })
                    .catch(error => {
                        deleteModal.classList.add('hidden');
                        console.error('Error deleting file:', error);
                        alert('Error deleting file');
                    });
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        });
    </script>
@endpush
