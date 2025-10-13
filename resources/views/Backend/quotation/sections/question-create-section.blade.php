@extends('Backend.quotation.index')

@push('styles')
    <style>
        .disabled_option_area {
            position: relative;
            user-select: none;
            opacity: 1;
            filter: blur(1px);
            cursor: no-drop;
        }

        .disabled_option_area::after {
            content: "";
            position: absolute;
            inset: 0;
            backdrop-filter: grayscale(0.3);
            border-radius: inherit;
            z-index: 2;
        }

        .disabled_option_area input,
        .disabled_option_area select,
        .disabled_option_area textarea,
        .disabled_option_area button {
            pointer-events: none;
            user-select: none;
        }
    </style>
@endpush

@section('quotation-section')
    <div id="quotation-tab" class="tab-content active">
        <div class="flex flex-col lg:!flex-row gap-6">
            <div class="w-full">
                <div class=" rounded-lg overflow-hidden">
                    <form id="question-form" action="{{ route('admin.question.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col lg:!flex-row gap-6">
                            <div class="w-full lg:!w-2/3">
                                <div class="bg-white p-6 rounded-lg shadow">
                                    <div class="grid grid-cols-1 gap-6">
                                        <div>
                                            <label for="question"
                                                class="block text-sm font-medium text-gray-700 mb-2">Question <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" id="question" name="question" required
                                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                                placeholder="Enter question" value="{{ old('question') }}" />
                                            @error('question')
                                                <p class="!text-red-600 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 my-3">Input Type <span
                                                class="text-red-600">*</span></label>
                                        <select name="input_type" required id="input_type_select"
                                            class="w-full p-3 border border-gray-300 rounded-lg">
                                            <option value="input">Input
                                            </option>
                                            <option value="radio">Single Choice
                                            </option>
                                            <option value="checkbox">
                                                Multiple Choices</option>
                                            <option value="file">File
                                            </option>
                                            <option value="number">
                                                Number</option>
                                        </select>
                                    </div>
                                    <div class="mt-4 flex justify-end space-x-3">
                                        <button type="submit"
                                            class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                                            <div class="flex items-center gap-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                                    <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                                    <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                                                </svg>
                                                <span>Create Question</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Options and Submit -->
                            <div class="w-full bg-white lg:!w-1/3 disabled_option_area" id="option_area">
                                <div class=" p-6 rounded-lg shadow">
                                    <div class="grid grid-cols-1 gap-6">
                                        <h5 class="block text-sm font-medium text-gray-700">Options <span
                                                class="text-red-600">*</span></h5>
                                        <div class="border-t border-gray-100"></div>

                                        <div id="options-container">
                                            @if (old('options'))
                                                @foreach (old('options') as $index => $option)
                                                    <div class="option-input mb-3 p-3 border border-gray-200 rounded-lg">
                                                        <div class="mb-2">
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Option
                                                                Text</label>
                                                            <input type="text"
                                                                name="options[{{ $index }}][option]"
                                                                value="{{ $option['option'] }}"
                                                                class="w-full p-2 border border-gray-300 rounded-lg"
                                                                placeholder="Enter option text">
                                                        </div>

                                                        @if ($index > 0)
                                                            <button type="button"
                                                                class="remove-option mt-2 text-red-600 flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M18 6 6 18" />
                                                                    <path d="m6 6 12 12" />
                                                                </svg>
                                                                <span class="ml-1">Remove Option</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="option-input mb-3 p-3 border border-gray-200 rounded-lg">
                                                    <div class="mb-2">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Option
                                                            Text</label>
                                                        <input type="text" name="options[0][option]"
                                                            class="w-full p-2 border border-gray-300 rounded-lg"
                                                            placeholder="Enter option text">
                                                    </div>

                                                </div>
                                            @endif
                                        </div>

                                        @error('options')
                                            <p class="!text-red-600 text-sm">{{ $message }}</p>
                                        @enderror
                                        @error('options.*.option')
                                            <p class="!text-red-600 text-sm">{{ $message }}</p>
                                        @enderror


                                        <button type="button" id="add-option" class="text-teal-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                            Add Another Option
                                        </button>

                                        <!-- Form Actions -->
                                        {{-- <div class="mt-4 flex justify-end space-x-3">
                                        <button type="submit" class="!bg-teal-600 hover:!bg-teal-700 text-white px-6 py-2 rounded-lg">
                                            <div class="flex items-center gap-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/>
                                                </svg>
                                                <span>Create Question</span>
                                            </div>
                                        </button>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            let optionCount = {{ old('options') ? count(old('options')) : 1 }};

            // Add option field
            $('#add-option').on('click', function() {
                const newInput = $(`
            <div class="option-input mb-3 p-3 border border-gray-200 rounded-lg">
                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Option Text</label>
                    <input
                        type="text"
                        name="options[${optionCount}][option]"
                        class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Enter option text"
                    >
                </div>
                <button type="button" class="remove-option mt-2 text-red-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    <span class="ml-1">Remove Option</span>
                </button>
            </div>
        `);

                $('#options-container').append(newInput);
                optionCount++;
            });

            // Remove option field
            $(document).on('click', '.remove-option', function() {
                if ($('.option-input').length > 1) {
                    $(this).closest('.option-input').remove();
                }
            });

            $("#input_type_select").change(function() {
                const value = $(this).val();
                if (["checkbox", "radio"].includes(value)) {
                    $("#option_area").removeClass("disabled_option_area");
                } else {
                    $("#option_area").addClass("disabled_option_area");
                }
            });
        });
    </script>
@endpush
