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
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Create New Package</span>
                    </div>
                </li>
            </ol>
            <a href="{{ route('admin.package.all') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                <div class="flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    <span>Back to Packages</span>
                </div>
            </a>
        </div>

        <form id="package-form" action="{{ route('admin.package.store') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:!flex-row gap-6">
                <div class="w-full lg:!w-2/3">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Package Name <span class="text-red-600 font-bold">*</span></label>
                                <input
                                    type="text" id="name" name="name" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                    placeholder="Enter package name"
                                    value="{{ old('name') }}"
                                />
                                @error('name')
                                    <p class="!text-red-600 text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="is_best_deal" class="block text-sm font-medium text-gray-700 mb-2">Is Best Deal</label>
                                <select name="is_best_deal" id="is_best_deal" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <div>
                                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Package Subtitle </label>
                                <textarea
                                    id="subtitle" name="subtitle" required rows="3"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                    placeholder="Enter package subtitle"
                                >{{ old('subtitle') }}</textarea>
                                @error('subtitle')
                                    <p class="!text-red-600 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Features and Submit -->
                <div class="w-full lg:!w-1/3">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="grid grid-cols-1 gap-6">
                            <h5 class="block text-sm font-medium text-gray-700">Package Features <span class="text-red-600 font-bold">*</span></h5>
                            <div class="border-t border-gray-100"></div>

                            <div id="features-container">
                                @if(old('features'))
                                    @foreach(old('features') as $index => $feature)
                                        <div class="feature-input mb-2 flex items-center">
                                            <input
                                                type="text"
                                                name="features[]"
                                                value="{{ $feature }}"
                                                class="flex-1 p-2 border border-gray-300 rounded-lg"
                                                placeholder="Enter feature"
                                            >
                                            @if($index > 0)
                                                <button type="button" class="remove-feature ml-2 text-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="feature-input mb-2 flex items-center">
                                        <input
                                            type="text"
                                            name="features[]"
                                            class="flex-1 p-2 border border-gray-300 rounded-lg"
                                            placeholder="Enter feature"
                                        >
                                    </div>
                                @endif
                            </div>

                            @error('features')
                                <p class="!text-red-600 text-sm">{{$message}}</p>
                            @enderror
                            @error('features.*')
                                <p class="!text-red-600 text-sm">{{$message}}</p>
                            @enderror

                            <button type="button" id="add-feature" class="text-teal-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <path d="M5 12h14"/><path d="M12 5v14"/>
                                </svg>
                                Add Another Feature
                            </button>

                            <!-- Form Actions -->
                            <div class="mt-4 flex justify-end space-x-3">
                                <button type="submit" class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                                    <div class="flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/>
                                        </svg>
                                        <span>Create Package</span>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add feature field
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const newInput = document.createElement('div');
        newInput.className = 'feature-input mb-2 flex items-center';
        newInput.innerHTML = `
            <input type="text" name="features[]" class="flex-1 p-2 border border-gray-300 rounded-lg" placeholder="Enter feature">
            <button type="button" class="remove-feature ml-2 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(newInput);
    });

    // Remove feature field
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature') || e.target.closest('.remove-feature')) {
            const removeBtn = e.target.classList.contains('remove-feature') ? e.target : e.target.closest('.remove-feature');
            const featureInput = removeBtn.closest('.feature-input');
            if (document.querySelectorAll('.feature-input').length > 1) {
                featureInput.remove();
            }
        }
    });
});
</script>
@endsection
