@extends('Backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tailwindcss-tag-input.css') }}">
@endpush
@section('contents')
    <div class="flex-1 p-3">
        <div class="max-w-[90rem] mx-auto">
            <div class="w-1/2 mx-auto">
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
                                <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Mail Settings</span>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm">
                @csrf
                <div class="flex flex-col lg:!flex-row gap-6">
                    <div class="w-1/2 mx-auto">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Admin Email -->
                                <div>
                                    <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Admin Email <span class="text-red-600 font-bold">*</span>
                                    </label>
                                    <input type="email" id="admin_email" name="admin_email"
                                        value="{{ $admin_email ?? '' }}"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Enter admin email address" />
                                    @error('admin_email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Admin BCC -->
                                <div>
                                    <label for="admin_bcc" class="block text-sm font-medium text-gray-700 mb-2">
                                        Admin BCC
                                    </label>
                                    <input type="text" id="admin_bcc" name="admin_bcc"
                                        class="tag-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Add with Enter or comma" value="{{ $admin_bcc ?? '' }}" />
                                    @error('admin_bcc')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Admin CC -->
                                <div>
                                    <label for="admin_cc" class="block text-sm font-medium text-gray-700 mb-2">
                                        Admin CC
                                    </label>
                                    <input type="text" id="admin_cc" name="admin_cc"
                                        class="tag-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Add with Enter or comma" value="{{ $admin_cc ?? '' }}" />
                                    @error('admin_cc')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="px-6 py-3 !bg-teal-600 text-white rounded-lg hover:!bg-teal-700 focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                                        Update Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/tailwindcss-tag-input.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize the TailwindCSS Tag Input System
            $('.tag-input').each(function() {
                initializeTagInput($(this));
            });

            // Optional: Form submission handler to verify the values
            $('#settingsForm').on('submit', function() {
                const bccValue = $('#admin_bcc').val();
                const ccValue = $('#admin_cc').val();

                console.log('BCC Values:', bccValue);
                console.log('CC Values:', ccValue);
            });
        });
    </script>
@endpush
