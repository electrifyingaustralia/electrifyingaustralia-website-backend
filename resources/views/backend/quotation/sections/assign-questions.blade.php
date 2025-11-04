@extends('backend.quotation.index')

@section('quotation-section')
    <div id="quotation-tab" class="tab-content active">
        <div class="flex flex-col lg:!flex-row gap-6">
            <div class="w-full">
                <div class="rounded-lg overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column - Assigned Questions -->
                        <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col max-h-screen">
                            <div class="px-6 py-5 border-b border-gray-200 flex-shrink-0">
                                <h3 class="text-lg font-medium text-gray-900">Assigned Questions</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-bold">Category:</span>
                                    "{{ $section->parentCat->category ?? $section->category }}"
                                </p>
                                @if ($section->parentCat)
                                    <p class="text-sm text-gray-600 mt-1">
                                        <span class="font-bold">Subcategory:</span>
                                        "{{ $section->category }}"
                                    </p>
                                @endif
                            </div>
                            <div class="px-6 py-5 flex-1 overflow-auto">
                                @php
                                    $groupedQuestions = $section->getQuestionsGrouped();
                                    $hasQuestions = $groupedQuestions->flatten()->count() > 0;
                                @endphp

                                @if ($hasQuestions)
                                    <div id="sortable-groups" class="space-y-6">
                                        @foreach ($groupedQuestions as $groupName => $questions)
                                            @php
                                                $groupId = $groupName ?: 'ungrouped';
                                            @endphp
                                            <div class="question-group border border-gray-200 rounded-lg p-4 bg-gray-50 group-container"
                                                data-group="{{ $groupId }}">
                                                <!-- Group Header with Drag Handle -->
                                                <div
                                                    class="mb-3 pb-2 border-b border-gray-200 flex items-center justify-between">
                                                    <h4 class="text-md font-semibold text-gray-800 flex items-center">
                                                        <span class="group-handle mr-2 text-gray-400 ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <line x1="3" y1="12" x2="21"
                                                                    y2="12"></line>
                                                                <line x1="3" y1="6" x2="21"
                                                                    y2="6"></line>
                                                                <line x1="3" y1="18" x2="21"
                                                                    y2="18"></line>
                                                            </svg>
                                                        </span>
                                                        {{ $groupName ?: 'General Questions' }}
                                                        <span class="ml-2 text-sm font-normal text-gray-600">
                                                            ({{ count($questions) }} questions)
                                                        </span>
                                                    </h4>
                                                </div>

                                                <!-- Questions List - NOT connected to other groups -->
                                                <ul class="sortable-questions space-y-3 group-{{ $groupId }}"
                                                    data-group="{{ $groupId }}">
                                                    @foreach ($questions as $question)
                                                        <li data-question-id="{{ $question->id }}"
                                                            class="sortable-item border border-gray-300 rounded-lg p-4 flex justify-between items-start bg-white hover:bg-gray-50 transition-colors duration-200">
                                                            <div class="flex items-start flex-1">
                                                                <span class="!mr-3 mt-1 text-gray-400 handle">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <line x1="3" y1="12" x2="21"
                                                                            y2="12"></line>
                                                                        <line x1="3" y1="6" x2="21"
                                                                            y2="6"></line>
                                                                        <line x1="3" y1="18" x2="21"
                                                                            y2="18"></line>
                                                                    </svg>
                                                                </span>
                                                                <div class="flex-1">
                                                                    <h4 class="text-sm font-medium text-gray-900 mb-2">
                                                                        {{ $question->question }}
                                                                    </h4>
                                                                    <div class="flex flex-wrap gap-2">
                                                                        <span
                                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                                                            {{ ucfirst($question->input_type) }}
                                                                        </span>
                                                                        @if ($question->question_tag)
                                                                            <span
                                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                                {{ $question->question_tag }}
                                                                            </span>
                                                                        @endif
                                                                        @if ($question->is_required)
                                                                            <span
                                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                                Required
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.quotation.remove-question', [$section->id, $question->id]) }}"
                                                                method="POST" class="ml-4 flex-shrink-0">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900 p-1 rounded transition-colors duration-200"
                                                                    onclick="return confirm('Are you sure you want to remove this question from the section?')"
                                                                    title="Remove Question">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M18 6 6 18" />
                                                                        <path d="m6 6 12 12" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-sm text-blue-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Drag groups to reorder them, and drag questions within groups to reorder.
                                            Changes are saved automatically.
                                        </p>
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No questions assigned</h3>
                                        <p class="text-gray-500 mb-4">Get started by adding questions from the available
                                            list on the right.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Column - Available Questions -->
                        <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col max-h-screen">
                            <div class="px-6 py-5 border-b border-gray-200 flex-shrink-0">
                                <h3 class="text-lg font-medium text-gray-900">Available Questions</h3>
                                <p class="text-sm text-gray-600 mt-1">Questions that can be assigned to this section</p>
                            </div>
                            <div class="px-6 py-5 flex-1 flex flex-col min-h-0">
                                <!-- Bulk Assign Form -->
                                @if ($availableQuestions->count() > 0)
                                    <form class="flex-1 flex flex-col min-h-0"
                                        action="{{ route('admin.quotation.assign-questions', $section->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="flex-1 overflow-y-auto mb-4 min-h-0 space-y-4">
                                            @foreach ($availableQuestions as $groupName => $group)
                                                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                                    <!-- Group Checkbox -->
                                                    @if (count($group) > 1 && $groupName)
                                                        <label
                                                            class="flex items-center mb-3 p-2 bg-white rounded border cursor-pointer hover:bg-gray-50">
                                                            <input id="question-group-{{ Str::slug($groupName) }}"
                                                                type="checkbox" value="{{ Str::slug($groupName) }}"
                                                                class="!mr-3 h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded checked-all-questions">
                                                            <span class="text-sm font-medium text-gray-900">Select All -
                                                                {{ $groupName }}</span>
                                                            <span
                                                                class="ml-2 text-xs text-gray-500 bg-gray-200 px-2 py-1 rounded-full">
                                                                {{ count($group) }} questions
                                                            </span>
                                                        </label>
                                                    @endif

                                                    <!-- Questions in Group -->
                                                    <div class="space-y-2">
                                                        @foreach ($group as $question)
                                                            <div
                                                                class="flex items-start p-3 bg-white rounded-lg border border-gray-200 hover:border-teal-300 transition-colors duration-200">
                                                                <input id="question-{{ $question->id }}" type="checkbox"
                                                                    name="questions[]" value="{{ $question->id }}"
                                                                    class="mt-1 !mr-3 h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
                                                                    data-value="{{ Str::slug($groupName ?? '') }}">
                                                                <label for="question-{{ $question->id }}"
                                                                    class="text-sm text-gray-700 flex-1 cursor-pointer">
                                                                    <div class="font-medium text-gray-900">
                                                                        {{ $question->question }}</div>
                                                                    <div class="flex items-center gap-2 mt-2">
                                                                        <span
                                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                                            {{ ucfirst($question->input_type) }}
                                                                        </span>
                                                                        @if ($question->question_tag)
                                                                            <span
                                                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                                                {{ $question->question_tag }}
                                                                            </span>
                                                                        @endif
                                                                        <span class="text-xs text-gray-500">
                                                                            {{ $question->options->count() }} options
                                                                        </span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="submit"
                                            class="w-full !bg-teal-600 hover:!bg-teal-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Assign Selected Questions
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center py-12 flex-1 flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">All questions assigned</h3>
                                        <p class="text-gray-500">All available questions have been assigned to this
                                            section.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .sortable-questions {
                min-height: 20px;
                position: relative;
            }

            .sortable-item {
                user-select: none;
            }

            .group-container {
                user-select: none;
            }

            .sortable-ghost {
                opacity: 0.4;
                background-color: #dbeafe !important;
                border: 2px dashed #3b82f6 !important;
            }

            .group-ghost {
                opacity: 0.6;
                background-color: #f0f9ff !important;
                border: 2px dashed #0ea5e9 !important;
            }

            .sortable-chosen {
                background-color: #f0f9ff !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: rotate(2deg);
            }

            .group-chosen {
                background-color: #f0f9ff !important;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                transform: rotate(1deg);
            }

            .sortable-drag {
                opacity: 0.8;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            }

            .question-group {
                transition: all 0.3s ease;
            }

            .handle,
            .group-handle {
                cursor: grab;
                transition: color 0.2s ease;
            }

            .handle:hover,
            .group-handle:hover {
                color: #6b7280;
            }

            .handle:active,
            .group-handle:active {
                cursor: grabbing;
                color: #374151;
            }

            .flash-message {
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .ui-sortable-helper {
                z-index: 10000 !important;
            }

            /* Prevent questions from being dragged outside their group */
            .sortable-questions.ui-sortable-disabled {
                opacity: 1;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

        <script>
            $(function() {
                // Check all questions in a group
                $(".checked-all-questions").click(function() {
                    const groupValue = $(this).val();
                    const isChecked = $(this).prop('checked');

                    $(`[data-value="${groupValue}"]`).each(function() {
                        $(this).prop('checked', isChecked);
                    });
                });

                // Initialize group sorting (groups can be reordered)
                $("#sortable-groups").sortable({
                    items: "> .group-container",
                    handle: ".group-handle",
                    placeholder: "group-ghost",
                    cursor: "move",
                    tolerance: "pointer",
                    opacity: 0.8,
                    revert: 150,
                    zIndex: 9999,
                    start: function(event, ui) {
                        ui.item.addClass('group-chosen');
                        $('body').addClass('cursor-grabbing');
                    },
                    stop: function(event, ui) {
                        ui.item.removeClass('group-chosen');
                        $('body').removeClass('cursor-grabbing');
                        updateQuestionOrder();
                    }
                });

                // Initialize question sorting within their own groups only
                $(".sortable-questions").each(function() {
                    const $list = $(this);
                    const groupId = $list.data('group');

                    $list.sortable({
                        // REMOVED connectWith to prevent cross-group dragging
                        items: "> .sortable-item",
                        placeholder: "sortable-ghost",
                        handle: ".handle",
                        cursor: "move",
                        tolerance: "pointer",
                        opacity: 0.8,
                        revert: 100,
                        zIndex: 10000,
                        containment: $list, // Restrict to own list
                        start: function(event, ui) {
                            ui.item.addClass('sortable-chosen');
                            $('body').addClass('cursor-grabbing');
                        },
                        stop: function(event, ui) {
                            ui.item.removeClass('sortable-chosen');
                            $('body').removeClass('cursor-grabbing');
                            updateQuestionOrder();
                        }
                    }).disableSelection();
                });

                // Function to update question order
                function updateQuestionOrder() {
                    const questionGroups = {};

                    // Collect question order by group
                    $(".question-group").each(function() {
                        const $group = $(this);
                        const groupName = $group.data('group');
                        questionGroups[groupName] = [];

                        $group.find('.sortable-questions .sortable-item').each(function() {
                            questionGroups[groupName].push($(this).data('question-id'));
                        });
                    });

                    console.log('Sending order update:', questionGroups);

                    // Send AJAX request to update order
                    $.ajax({
                        url: "{{ route('admin.quotation.update-question-order', $section->id) }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            question_groups: questionGroups
                        },
                        success: function(response) {
                            if (response.success) {
                                showFlashMessage('Question order updated successfully!', 'success');
                            } else {
                                showFlashMessage('Error updating question order', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating order:', error);
                            showFlashMessage('Error updating question order. Please try again.', 'error');
                        }
                    });
                }

                // Function to show flash messages
                function showFlashMessage(message, type) {
                    // Remove any existing flash messages
                    $('.flash-message').remove();

                    // Create new flash message
                    const alertClass = type === 'success' ?
                        'bg-green-100 border-green-400 text-green-700' :
                        'bg-red-100 border-red-400 text-red-700';

                    const icon = type === 'success' ?
                        '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                        '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

                    const flashMessage = $(
                        `<div class="flash-message fixed top-4 right-4 z-50 px-6 py-4 rounded-lg border ${alertClass} shadow-lg flex items-center">
                    ${icon}
                    <span class="font-medium">${message}</span>
                </div>`
                    );

                    // Add to page and auto-remove after 4 seconds
                    $('body').append(flashMessage);
                    setTimeout(function() {
                        flashMessage.fadeOut(500, function() {
                            $(this).remove();
                        });
                    }, 4000);
                }

                // Auto-hide flash messages on click
                $(document).on('click', '.flash-message', function() {
                    $(this).fadeOut(300, function() {
                        $(this).remove();
                    });
                });

                // Add body class for cursor during drag
                $('body').on('mousedown', '.handle, .group-handle', function() {
                    $('body').addClass('cursor-grabbing');
                }).on('mouseup', function() {
                    $('body').removeClass('cursor-grabbing');
                });
            });
        </script>
    @endpush

    <style>
        /* body.cursor-grabbing {
                                    cursor: grabbing !important;
                                }

                                body.cursor-grabbing * {
                                    cursor: grabbing !important;
                                } */
    </style>
@endsection
