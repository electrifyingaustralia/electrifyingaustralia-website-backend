@extends('backend.layouts.app')

@section('contents')
    <div class="flex-1 p-3">
        <div class="max-w-6xl mx-auto">
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
                            <a href="{{ route('admin.customer.all') }}"
                                class="ml-1 text-lg font-medium text-gray-700 hover:!text-teal-600 md:ml-2">
                                Customer Quotations
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">
                                Quotation Details
                            </span>
                        </div>
                    </li>
                </ol>
                <div class="flex gap-2">
                    <a href="{{ route('admin.customer.all') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Back to List
                    </a>
                    @if (!$editMode)
                        <button onclick="confirmDelete({{ $customer->id }})"
                            class="!bg-red-600 hover:!bg-red-700 text-white px-4 py-2 rounded-lg">
                            Delete
                        </button>
                    @endif
                </div>
            </div>

            {{-- Customer Information --}}
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Customer Information</h2>
                    @if (!$editMode)
                        <a href="{{ request()->fullUrlWithQuery(['edit' => 'true']) }}"
                            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                            Edit Information
                        </a>
                    @endif
                </div>

                @if ($editMode)
                    <form action="{{ route('admin.customer.update', $customer) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="first_name"
                                    value="{{ old('first_name', $customer->first_name) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('first_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $customer->last_name) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('last_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea name="address" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ old('address', $customer->address) }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                            <a href="{{ route('admin.customer.show', $customer) }}"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 !bg-teal-600 text-white rounded-lg hover:!bg-teal-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                @else
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <p class="text-gray-900">{{ $customer->first_name ? $customer->full_name : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ $customer->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <p class="text-gray-900">{{ $customer->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <p class="text-gray-900">{{ $customer->address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <p class="text-gray-900">{{ $customer->category->category ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sub Category</label>
                            <p class="text-gray-900">{{ $customer->subCategory->category ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Package</label>
                            @if ($customer->package)
                                <p class="text-gray-900 font-medium">{{ $customer->package->name }}</p>
                                @if ($customer->package->is_best_deal)
                                    <span class="text-xs px-2 py-0.5 bg-amber-100 text-amber-800 rounded-full">
                                        Best Deal
                                    </span>
                                @endif
                            @else
                                <p class="text-gray-500">N/A</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <p class="text-gray-900">{{ $customer->type ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'viewed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $color = $statusColors[$customer->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Submitted On</label>
                            <p class="text-gray-900">{{ $customer->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <p class="text-gray-900">{{ $customer->message ?? 'N/A' }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Package Information Section --}}
            @if ($customer->package)
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Selected Package Details</h2>
                        @if ($customer->package->is_best_deal)
                            <span class="inline-block mt-1 px-3 py-1 text-sm bg-amber-100 text-amber-800 rounded-full">
                                🔥 Best Deal Package
                            </span>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $customer->package->name }}</h3>
                            <p class="text-gray-600">{{ $customer->package->subtitle }}</p>
                        </div>

                        @if ($customer->package->features->count() > 0)
                            <div>
                                <h4 class="font-medium text-gray-700 mb-3">Package Features</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($customer->package->features as $feature)
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-gray-700">{{ $feature->feature }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Quotation Answers --}}
            @if ($customer->answers->count() > 0)
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Customer Answers to Questions</h2>
                    </div>
                    <div class="p-6">
                        @forelse ($customer->answers as $answer)
                            <div class="border-b border-gray-200 py-4 last:border-b-0">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h5 class="font-medium text-gray-900 mb-2">{{ $answer->question->question }}</h5>

                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            {{-- File Type --}}
                                            @if ($answer->answer_type === 'file' && isset($answer->attrs['path']))
                                                <a href="{{ getAssetFileUrl('quotation', $answer->attrs['random_name'], disk: env('FILESYSTEM_DISK', 'public')) }}"
                                                    target="_blank"
                                                    class="text-teal-600 hover:underline flex justify-start items-center gap-x-6">
                                                    <div class="size-14">
                                                        @if (in_array($answer->attrs['extension'], ['jpeg', 'jpg', 'png', 'gif', 'webp', 'svg']))
                                                            <img class="w-full object-contain rounded-lg"
                                                                src="{{ getAssetFileUrl('quotation', $answer->attrs['random_name'], disk: env('FILESYSTEM_DISK', 'public')) }}"
                                                                alt="">
                                                        @elseif ($answer->attrs['extension'] == 'pdf')
                                                            <img class="w-full object-contain rounded-lg"
                                                                src="{{ asset('/assets/images/pdf-image.jpg') }}"
                                                                alt="">
                                                        @else
                                                            <img class="w-full object-contain rounded-lg"
                                                                src="{{ asset('/assets/images/doc-image.png') }}"
                                                                alt="">
                                                        @endif
                                                    </div>
                                                    {{ $answer->attrs['original_name'] ?? 'View File' }}
                                                </a>

                                                {{-- Checkbox or Multiple --}}
                                            @elseif (isset($answer->attrs['value']) && is_array($answer->attrs['value']))
                                                <ul class="list-disc list-inside space-y-1">
                                                    @foreach ($answer->attrs['value'] as $val)
                                                        <li class="text-gray-700">{{ $val }}</li>
                                                    @endforeach
                                                </ul>

                                                {{-- Normal Input / Radio --}}
                                            @elseif (isset($answer->attrs['value']))
                                                <p class="text-gray-700">{{ $answer->attrs['value'] }}</p>

                                                {{-- Fallback --}}
                                            @else
                                                <p class="text-gray-500 italic">No answer provided</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ml-4">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($answer->answer_type) }}
                                        </span>
                                        @if ($answer->question->is_required)
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 ml-1">
                                                Required
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-gray-500">No answers provided for this quotation.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            {{-- Service Requests --}}
            @if ($customer->customerServices->count() > 0)
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Service Requests</h2>
                        <p class="text-gray-600 text-sm mt-1">All service requests submitted by this customer</p>
                    </div>
                    <div class="p-6">
                        @foreach ($customer->customerServices as $service)
                            <div class="border border-gray-200 rounded-lg mb-4 last:mb-0">
                                <div
                                    class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                                    <div>
                                        <span class="font-medium text-gray-900">Service Number:
                                            {{ $service->service_number }}</span>
                                        <span class="ml-4 text-sm text-gray-500">
                                            Submitted: {{ $service->created_at->format('M d, Y \a\t h:i A') }}
                                        </span>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ $service->product_type }}
                                        </span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                            {{ $service->issue_type }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Product
                                                Type</label>
                                            <p class="text-gray-900">{{ $service->product_type }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Issue Type</label>
                                            <p class="text-gray-900">{{ $service->issue_type }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Issue Details</label>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <p class="text-gray-700 whitespace-pre-line">
                                                {{ $service->issue_details ?? 'No details provided' }}</p>
                                        </div>
                                    </div>

                                    @if ($service->attachment)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Attachment</label>
                                            @php
                                                $attachment = json_decode($service->attachment, true);
                                            @endphp
                                            @if ($attachment && isset($attachment['path']))
                                                <a href="{{ getAssetFileUrl('service', $attachment['random_name'], disk: env('FILESYSTEM_DISK', 'public')) }}"
                                                    target="_blank"
                                                    class="text-teal-600 hover:underline flex items-center gap-2">
                                                    <div class="size-10">
                                                        @if (in_array($attachment['extension'] ?? '', ['jpeg', 'jpg', 'png', 'gif', 'webp', 'svg']))
                                                            <img class="w-full h-full object-cover rounded"
                                                                src="{{ getAssetFileUrl('service', $attachment['random_name'], disk: env('FILESYSTEM_DISK', 'public')) }}"
                                                                alt="{{ $attachment['original_name'] ?? 'Attachment' }}">
                                                        @elseif (($attachment['extension'] ?? '') == 'pdf')
                                                            <img class="w-full h-full object-contain rounded"
                                                                src="{{ asset('/assets/images/pdf-image.jpg') }}"
                                                                alt="PDF Document">
                                                        @else
                                                            <img class="w-full h-full object-contain rounded"
                                                                src="{{ asset('/assets/images/doc-image.png') }}"
                                                                alt="Document">
                                                        @endif
                                                    </div>
                                                    <span>{{ $attachment['original_name'] ?? 'View Attachment' }}</span>
                                                </a>
                                            @else
                                                <p class="text-gray-500 italic">Invalid attachment data</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    @if (!$editMode)
        <div id="delete-modal" class="fixed inset-0 bg-black/30 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
                <p class="text-gray-600 mb-6">
                    Are you sure you want to delete this customer quotation? This action cannot be undone.
                </p>
                <div class="flex justify-end gap-x-3">
                    <button onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 !bg-red-600 text-white rounded-lg hover:!bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            const form = document.getElementById('delete-form');
            form.action = `/admin/customers/${id}`;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
@endpush
