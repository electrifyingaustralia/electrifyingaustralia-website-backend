@extends('backend.layouts.app')
@section('contents')
    <div class="flex-1 p-3">
        <div class="max-w-[90rem] mx-auto">
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
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">All Projects</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.project.create') }}"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        <span>Add Project</span>
                    </div>
                </a>
            </div>
            <!-- Search -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <form action="{{ route('admin.project.all') }}" method="GET">
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search projects..." class="w-full p-2 border !border-gray-300 rounded-lg">
                        </div>
                        <button type="submit" class="!bg-black text-white px-4 py-2 rounded-lg">
                            <div class="flex justify-center items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-1" width="20" height="20"
                                    viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-search-icon lucide-search">
                                    <path d="m21 21-4.34-4.34" />
                                    <circle cx="11" cy="11" r="8" />
                                </svg>
                                <span>Search</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Projects Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs border-b">
                            <tr>
                                <th class="px-6 py-4 font-medium">Media</th>
                                <th class="px-6 py-4 font-medium">Title</th>
                                <th class="px-6 py-4 font-medium">Subtitle</th>
                                <th class="px-6 py-4 font-medium">Category</th>
                                <th class="px-6 py-4 font-medium">Type</th>
                                <th class="px-6 py-4 font-medium text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($projects as $project)
                                <tr class="">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if (optional($project->media)->url)
                                                <img src="{{ optional($project->media)->url }}"
                                                    alt="{{ $project->media->alt_name ?? $project->title }}"
                                                    class="w-16 h-12 object-scale-down rounded-lg border border-gray-200">
                                            @else
                                                <div
                                                    class="w-16 h-12 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="text-gray-400">
                                                        <path
                                                            d="M13.997 4a2 2 0 0 1 1.76 1.05l.486.9A2 2 0 0 0 18.003 7H20a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1.997a2 2 0 0 0 1.759-1.048l.489-.904A2 2 0 0 1 10.004 4z" />
                                                        <circle cx="12" cy="13" r="3" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-[200px]">
                                            <span
                                                class="font-medium text-gray-900 line-clamp-2">{{ $project->title }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-[200px]">
                                            <span class="text-gray-600 line-clamp-2">{{ $project->subtitle }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $project->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $project->type->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.project.show', $project->id) }}"
                                                class="p-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors duration-200"
                                                title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12c-4.411 0-7.757-3.134-9.223-5 1.466-1.866 4.812-5 9.223-5s7.757 3.134 9.223 5c-1.466 1.866-4.812 5-9.223 5z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.project.edit', $project->id) }}"
                                                class="p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                title="Edit">
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
                                            <a href="{{ route('admin.project.assign-images', $project->id) }}"
                                                class="p-2 text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-lg transition-colors duration-200"
                                                title="Assign Images">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 5h6" />
                                                    <path d="M19 2v6" />
                                                    <path
                                                        d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5" />
                                                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                                    <circle cx="9" cy="9" r="2" />
                                                </svg>
                                            </a>
                                            <button type="button" onclick="confirmDelete({{ $project->id }})"
                                                class="p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2zM10 4V3h4v1z" />
                                                    <path
                                                        d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" class="text-gray-400 mb-3">
                                                <path
                                                    d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2" />
                                            </svg>
                                            <span class="text-lg font-medium text-gray-600 mb-1">No projects found</span>
                                            <span class="text-sm">Upload your first project to get started!</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @include('backend.components.pagination', ['paginator' => $projects])
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/30 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md mx-4 shadow-xl">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Confirm Delete</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this project? This action cannot be undone.</p>
            <div class="flex justify-end gap-x-3">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">Cancel</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 !bg-red-600 text-white rounded-lg hover:!bg-red-700 transition-colors duration-200">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            const form = document.getElementById('delete-form');
            form.action = `/admin/project/${id}`;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target.id === 'delete-modal') {
                closeDeleteModal();
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
