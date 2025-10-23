@extends('backend.layouts.app')
@section('contents')
    @push('styles')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    @endpush
    <div class="flex-1 p-6">
        <div class="max-w-5xl mx-auto">
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
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Edit Admin User</span>
                        </div>
                    </li>
                    <li aria-current="page" class="hidden lg:block">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ml-1 text-lg font-medium text-gray-500 md:ml-2 truncate lg:!max-w-[15rem]">{{ $admin->name }}</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.users.all') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        <span>Back to Admin Users</span>
                    </div>
                </a>
            </div>

            <form id="admin-form" action="{{ route('admin.users.update', $admin->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col lg:!flex-row gap-6">
                    <div class="w-full lg:!w-2/3">
                        <!-- Sticky Headers Table -->
                        <div class="bg-white p-6 rounded-lg shadow">

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name <span
                                            class="text-red-600">*</span></label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        value="{{ old('name', $admin->name) }}" placeholder="Enter admin user name" />
                                    @error('name')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                            class="text-red-600">*</span></label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        value="{{ old('email', $admin->email) }}" placeholder="Enter admin email" />
                                    @error('email')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Media Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Media <span
                                            class="text-red-600">*</span></label>

                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <!-- Media Preview -->
                                        <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50"
                                            id="logo-preview">
                                            @if ($admin->media)
                                                @if ($admin->media->mime_type && str_starts_with($admin->media->mime_type, 'image/'))
                                                    <img src="{{ $admin->media->url }}" alt="{{ $admin->title }}"
                                                        class="w-full h-full object-cover rounded-lg">
                                                @elseif($admin->media->mime_type && str_starts_with($admin->media->mime_type, 'video/'))
                                                    <div
                                                        class="w-full h-full flex items-center justify-center bg-gray-200 rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40"
                                                            height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-video text-gray-600">
                                                            <path
                                                                d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5" />
                                                            <rect x="2" y="6" width="14" height="12"
                                                                rx="2" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    @php
                                                        $fileExtension = pathinfo(
                                                            $admin->media->original_name,
                                                            PATHINFO_EXTENSION,
                                                        );
                                                        $bgColor = 'bg-gray-200';
                                                        $iconSvg = '';

                                                        switch (strtolower($fileExtension)) {
                                                            case 'pdf':
                                                                $bgColor = 'bg-red-100';
                                                                $iconSvg =
                                                                    '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                                                                break;
                                                            case 'doc':
                                                            case 'docx':
                                                                $bgColor = 'bg-blue-100';
                                                                $iconSvg =
                                                                    '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                                                                break;
                                                            case 'xls':
                                                            case 'xlsx':
                                                                $bgColor = 'bg-green-100';
                                                                $iconSvg =
                                                                    '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/>';
                                                                break;
                                                            default:
                                                                $bgColor = 'bg-gray-200';
                                                                $iconSvg =
                                                                    '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/>';
                                                        }
                                                    @endphp
                                                    <div
                                                        class="w-full h-full flex items-center justify-center {{ $bgColor }} rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40"
                                                            height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide">
                                                            {!! $iconSvg !!}
                                                        </svg>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="text-center text-gray-400">
                                                    <i class="fas fa-image text-2xl mb-2"></i>
                                                    <p class="text-xs">No media selected</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Media Actions -->
                                        <div class="flex flex-col justify-center gap-2">
                                            <button type="button" id="open-media-library"
                                                class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg">
                                                <div class="flex items-center gap-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-upload-icon lucide-upload">
                                                        <path d="M12 3v12" />
                                                        <path d="m17 8-5-5-5 5" />
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                    </svg>
                                                    <span>Change Media</span>
                                                </div>
                                            </button>

                                            <input type="hidden" id="selected-media-id" name="media_id"
                                                value="{{ old('media_id', $admin->media_id) }}">
                                        </div>
                                    </div>

                                    <!-- Selected Media Info -->
                                    <div id="selected-logo-info"
                                        class="mt-3 p-3 bg-gray-50 rounded-lg {{ $admin->media ? '' : 'hidden' }}">
                                        @if ($admin->media)
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    @if ($admin->media->mime_type && str_starts_with($admin->media->mime_type, 'image/'))
                                                        <img id="selected-logo-preview" src="{{ $admin->media->url }}"
                                                            alt="Selected media" class="w-12 h-12 object-cover rounded">
                                                    @else
                                                        @php
                                                            $fileExtension = pathinfo(
                                                                $admin->media->original_name,
                                                                PATHINFO_EXTENSION,
                                                            );
                                                            $bgColor = 'bg-gray-200';
                                                            $iconSvg = '';

                                                            switch (strtolower($fileExtension)) {
                                                                case 'pdf':
                                                                    $bgColor = 'bg-red-100';
                                                                    $iconSvg =
                                                                        '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                                                                    break;
                                                                case 'doc':
                                                                case 'docx':
                                                                    $bgColor = 'bg-blue-100';
                                                                    $iconSvg =
                                                                        '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                                                                    break;
                                                                case 'xls':
                                                                case 'xlsx':
                                                                    $bgColor = 'bg-green-100';
                                                                    $iconSvg =
                                                                        '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/>';
                                                                    break;
                                                                default:
                                                                    $bgColor = 'bg-gray-200';
                                                                    $iconSvg =
                                                                        '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/>';
                                                            }
                                                        @endphp
                                                        <div
                                                            class="w-12 h-12 flex items-center justify-center {{ $bgColor }} rounded">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide">
                                                                {!! $iconSvg !!}
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <p id="selected-logo-name" class="text-sm font-medium">
                                                            {{ $admin->media->original_name }}</p>
                                                        <p id="selected-logo-size" class="text-xs text-gray-500">
                                                            {{ formatFileSize($admin->media->file_size) }}</p>
                                                    </div>
                                                </div>
                                                <button type="button" id="remove-selected-logo"
                                                    class="text-red-600 hover:text-red-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-trash2-icon lucide-trash-2">
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
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
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                        <span class="text-red-600">*</span></label>
                                    <input type="password" id="password" name="password" required
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter admin user password" />
                                    @error('password')
                                        <p class="!text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Confirm Password <span
                                            class="text-red-600">*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        required
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Confirm password" />
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
                                            <span>Update Admin User</span>
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
            <div class="flex-1 overflow-auto min-h-[35rem]">
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
            let selectedMedia = null;
            let currentTab = 'upload';
            let mediaLibraryItems = [];
            let isUploading = false;

            // Initialize with existing logo data if available
            @if ($admin->media)
                selectedMedia = {
                    id: {{ $admin->media_id }},
                    url: '{{ $admin->media->url }}',
                    name: '{{ $admin->media->original_name }}',
                    size: {{ $admin->media->file_size }},
                    file: null,
                    type: 'library'
                };
            @endif

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
            let currentPage = 1;
            let hasMorePages = true;

            function loadMediaLibrary(loadMore = false) {
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
                }

                $.ajax({
                    url: '{{ route('admin.media.ajax.all') }}?perPage=50&page=' + currentPage,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        if (data.data && data.data.length > 0) {
                            mediaLibraryItems = [...mediaLibraryItems, ...data.data];
                            renderMediaLibrary(mediaLibraryItems);

                            // Check if there are more pages
                            hasMorePages = data.current_page < data.last_page;
                            currentPage++;

                            // Add or update load more button
                            updateLoadMoreButton();
                        } else {
                            if (mediaLibraryItems.length === 0) {
                                showNoMediaMessage();
                            }
                            hasMorePages = false;
                            updateLoadMoreButton();
                        }
                    },
                    error: function(error) {
                        console.error('Error loading media library:', error);
                        showErrorLoadingMedia();
                    }
                });
            }

            function updateLoadMoreButton() {
                let $loadMoreBtn = $('#load-more-media');

                if (hasMorePages) {
                    if ($loadMoreBtn.length === 0) {
                        $('#media-library-content').after(`
                    <div class="text-center mt-4">
                        <button id="load-more-media" class="!bg-teal-600 hover:!bg-teal-700 text-white px-4 py-2 rounded-lg">
                            Load More Media
                        </button>
                    </div>
                `);

                        $('#load-more-media').on('click', function() {
                            loadMediaLibrary(true);
                        });
                    }
                } else {
                    $loadMoreBtn.remove();
                }
            }

            function renderMediaLibrary(mediaItems, append = false) {
                const $mediaContent = $('#media-library-content');

                let html = '';

                if (!append) {
                    html = '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">';
                }

                // Calculate starting index for new items
                const startIndex = append ? $mediaContent.find('.media-item').length : 0;

                $.each(mediaItems.slice(startIndex), function(index, media) {
                    const actualIndex = startIndex + index;

                    // Your existing media item HTML generation code
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
                    } else {
                        // Your existing document type handling...
                    }

                    html += `
                <div class="media-item bg-gray-100 rounded-lg overflow-hidden cursor-pointer transition-all hover:shadow-md"
                    data-index="${actualIndex}">
                    ${previewHtml}
                    <div class="p-2">
                        <p class="text-xs text-center font-medium truncate">${media.original_name}</p>
                    </div>
                </div>
                `;
                });

                if (!append) {
                    html += '</div>';
                    $mediaContent.html(html);
                } else {
                    $mediaContent.find('.grid').append(html);
                }

                // Re-bind click events for new items
                $mediaContent.find('.media-item').off('click').on('click', function() {
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

                updateConfirmButtonState();
                updateUploadButtonState();
            }

            function closeMediaLibrary() {
                $('#media-library-modal').addClass('hidden');
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
                } else if (selectedMedia.url.match(/\.(mp4|web极|ogg|mov|avi|wmv)$/i) ||
                    (selectedMedia.mime_type && selectedMedia.mime_type.startsWith('video/'))) {
                    // Video files
                    $('#logo-preview').html(`
                <div class="w-full h-full flex items-center justify-center bg-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin极 round" class="lucide lucide-video text-gray-600">
                        <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/>
                        <rect x="2" y="6" width="14" height="12" rx="2"/>
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
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2极 4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                            break;
                        case 'doc':
                        case 'docx':
                            bgColor = 'bg-blue-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v极 4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
                            break;
                        case 'xls':
                        case 'xlsx':
                            bgColor = 'bg-green-100';
                            iconSvg =
                                '<rect width="18" height="18" x极 3" y="3" rx="2" ry="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/>';
                            break;
                        default:
                            bgColor = 'bg-gray-200';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/>';
                    }

                    $('#logo-preview').html(`
                <div class="w-full h-full flex items-center justify-center ${bgColor} rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide">
                        ${iconSvg}
                    </svg>
                </div>
            `);
                }

                // Update selected logo info
                if (selectedMedia.url.match(/\.(jpg|jpeg|png|gif|svg|webp)$/i) ||
                    (selectedMedia.mime_type && selectedMedia.mime_type.startsWith('image/'))) {
                    // Show image preview
                    $('#selected-logo-info').html(`
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img id="selected-logo-preview" src="${selectedMedia.url}" alt="Selected media" class="w-12 h-12 object-cover rounded">
                        <div>
                            <p id="selected-logo-name" class="text-sm font-medium">${selectedMedia.name}</p>
                            <p id="selected-logo-size" class="text-xs text-gray-500">${formatFileSize(selectedMedia.size)}</p>
                        </div>
                    </div>
                    <button type="button" id="remove-selected-logo" class="text-red-600 hover:text-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                            <path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6极 14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
            `);
                } else {
                    // Show icon preview
                    const fileExtension = selectedMedia.name.split('.').pop().toLowerCase();
                    let bgColor = 'bg-gray-200';
                    let iconSvg = '';

                    switch (fileExtension) {
                        case 'pdf':
                            bgColor = 'bg-red-100';
                            iconSvg =
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 极 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>';
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
                                '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><极 d="M14 2v4a2 2 极 0 0 2 2h4"/>';
                    }

                    $('#selected-logo-info').html(`
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 flex items-center justify-center ${bgColor} rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide">
                                ${iconSvg}
                            </svg>
                        </div>
                        <div>
                            <p id="selected-logo-name" class="text-sm font-medium">${selectedMedia.name}</p>
                            <p id="selected-logo-size" class="text-xs text-gray-500">${formatFileSize(selectedMedia.size)}</p>
                        </div>
                    </div>
                    <button type="button" id="remove-selected-logo" class="text-red-600 hover:text-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                            <path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
            `);
                }

                // Re-bind the remove event listener
                $('#remove-selected-logo').on('click', removeSelectedLogo);

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

                $('#selected-logo-info').addClass('hidden').html('');
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

            $('#admin-form').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = new FormData(this);

                console.log('FormData contents:');
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

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
                            localStorage.setItem('toastr_success', response.message);
                            window.location.href = response.redirect ||
                                '{{ route('admin.users.all') }}';
                        } else {
                            toastr.error(response.message || 'An error occurred');
                            $('button[type="submit"]').prop('disabled', false).text(
                                'Update Admin');
                        }
                    },
                    error: function(xhr) {
                        console.log('Error details:', xhr);
                        console.log('Response:', xhr.responseJSON);

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = 'Validation errors:<br>';
                            for (var field in errors) {
                                errorMessage += '- ' + errors[field].join('<br>') + '<br>';
                            }
                            toastr.error(errorMessage);
                        } else {
                            toastr.error('Error: ' + (xhr.responseJSON?.message ||
                                'Please check console'));
                        }
                        $('button[type="submit"]').prop('disabled', false).text('Update Admin');
                    }
                });
            });

            // Initialize on page load
            updateConfirmButtonState();
            updateUploadButtonState();
        });
    </script>
@endpush











































{{-- @extends('backend.layouts.app')
@section('contents')
    <div class="mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <!-- Breadcrumb -->
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:!text-teal-600">
                            <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit User</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $admin->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Add User Button -->
            <a href="{{ route('admin.users.all') }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden px-8 pb-6">
            <form action="{{ route('admin.users.update', $admin->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <!-- Avatar Upload -->
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <div class="mt-1 flex items-center">
                        <!-- Preview Container -->
                        <div class="mr-4">
                            <img id="avatar-preview" src="{{ asset('assets/images/avatar-2.png') }}"
                                class="h-16 w-16 rounded-full object-cover border-2 border-gray-300">
                        </div>

                        <!-- File Input -->
                        <div class="flex-1">
                            <input type="file" name="avatar" id="avatar" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG up to 10MB</p>
                        </div>
                    </div>
                </div>

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <div class="mt-1">
                        <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input type="password" name="password" id="password"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                        >
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="mt-1">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                        >
                    </div>
                </div>
                <div class="">
                    <button type="submit"
                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white !bg-teal-600 rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection --}}
