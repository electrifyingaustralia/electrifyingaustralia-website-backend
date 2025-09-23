@extends('Backend.layouts.app')
@section('contents')
<div class="flex-1 p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-lg font-medium text-gray-700 hover:!text-teal-600">
                        <svg class="w-5 h-5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2极-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.package.all') }}" class="inline-flex items-center text-lg font-medium text-gray-700 hover:!text-teal-600">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4极-4-4"/>
                        </svg>
                        Packages
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">View Package</span>
                    </div>
                </li>
            </ol>
            <a href="{{ route('admin.package.all') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                <div class="flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    <span>Back to Packages</span>
                </div>
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $package->name }}</h2>
                    <p class="text-gray-600 mb-4">{{ $package->subtitle }}</p>

                    <div class="mb-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                            Status: {{ $package->is_best_deal ? 'Best Deal' : 'Standard' }}
                        </span>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Features</h3>
                        <ul class="space-y-2">
                            @foreach($package->features as $feature)
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-teal-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $feature->feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Package Details</h3>

                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Created At</p>
                                <p class="text-gray-800">{{ $package->created_at->format('M d, Y') }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600">Last Updated</p>
                                <p class="text-gray-800">{{ $package->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.package.edit', $package->id) }}" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                </svg>
                                Edit Package
                            </a>

                            <form action="{{ route('admin.package.delete', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this package?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                    Delete Package
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
