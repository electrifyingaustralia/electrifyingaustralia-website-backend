@extends('backend.layouts.app')
@section('contents')
    <div class="flex-1 p-6">
        <div class="max-w-5xl mx-auto">
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">Change Password</span>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <div class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        <span>Back to Dashboard</span>
                    </div>
                </a>
            </div>

            <!-- Change Password Form -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Change Password</h2>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.users.update-password') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Password <span class="text-red-600 font-bold">*</span>
                            </label>
                            <input type="password" id="current_password" name="current_password" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="Enter your current password" />
                            @error('current_password')
                                <p class="!text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                New Password <span class="text-red-600 font-bold">*</span>
                            </label>
                            <input type="password" id="new_password" name="new_password" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="Enter new password" />
                            @error('new_password')
                                <p class="!text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm New Password <span class="text-red-600 font-bold">*</span>
                            </label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="Confirm new password" />
                            @error('new_password_confirmation')
                                <p class="!text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-4 flex justify-end space-x-3">
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
                                <div class="flex items-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-x-icon lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg>
                                    <span>Cancel</span>
                                </div>
                            </a>
                            <button type="submit" class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                                <div class="flex items-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-save-icon lucide-save">
                                        <path
                                            d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                        <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                        <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                                    </svg>
                                    <span>Update Password</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Password confirmation validation - visual feedback only
            $('#new_password, #new_password_confirmation').on('keyup', function() {
                const password = $('#new_password').val();
                const confirmPassword = $('#new_password_confirmation').val();

                if (password !== confirmPassword && confirmPassword !== '') {
                    $('#new_password_confirmation').addClass('border-red-500');
                } else {
                    $('#new_password_confirmation').removeClass('border-red-500');
                }
            });

            // Clear red border when user focuses on confirmation field
            $('#new_password_confirmation').on('focus', function() {
                $(this).removeClass('border-red-500');
            });
        });
    </script>
@endpush
