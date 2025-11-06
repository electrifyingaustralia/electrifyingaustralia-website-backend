@extends('backend.layouts.app')
@section('contents')
    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
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
                    <li class="inline-flex items-center">
                        <div class="inline-flex items-center text-lg font-medium text-gray-700">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            Projects
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">View Project</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.project.all') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        <span>Back to All Projects</span>
                    </div>
                </a>
            </div>

            <!-- Project Details Card -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $project->title }}</h2>
                                <p class="text-gray-600 mb-1">{{ $project->subtitle }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                            <div class="text-gray-700 bg-gray-50 p-4 rounded-lg">
                                {!! $project->description ?? '<span class="text-gray-400">No description available</span>' !!}
                            </div>
                        </div>

                        <!-- Project Images Gallery -->
                        @if (count($project->images) > 0)
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Associate Image Gallery</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach ($project->images as $image)
                                        <div class="bg-gray-100 rounded-lg overflow-hidden">
                                            <img src="{{ $image->url }}" alt="Project Image"
                                                class="w-full h-32 object-scale-down">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-1">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Featured Image</h3>

                            <!-- Main Project Image -->
                            @if (optional($project->media)->url)
                                <div class="mb-4">
                                    <img src="{{ optional($project->media)->url }}"
                                        alt="{{ $project->media->alt_name ? $project->media->alt_name : $project->title }}"
                                        class="w-full h-48 object-fit rounded-lg">
                                </div>
                            @endif

                            <div class="space-y-3">
                                {{-- <div>
                                <p class="text-sm text-gray-600">Status</p>
                                @if ($project->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">Active</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </div> --}}

                                <div>
                                    <p class="text-sm text-gray-600">Project Category</p>
                                    <p class="text-blue-800 font-bold">{{ ucfirst($project->category) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Project Type</p>
                                    <p class="text-amber-600 font-bold">{{ ucfirst($project->type->name) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Created At</p>
                                    <p class="text-gray-800">{{ formatDate($project->created_at) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Last Updated</p>
                                    <p class="text-gray-800">{{ formatDate($project->updated_at) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Total Images</p>
                                    <p class="text-gray-800">{{ count($project->images) }} images</p>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200 space-y-2">
                                <a href="{{ route('admin.project.edit', $project->id) }}"
                                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path
                                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                    </svg>
                                    Edit Project
                                </a>

                                <a href="{{ route('admin.project.assign-images', $project->id) }}"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    Manage Images
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
