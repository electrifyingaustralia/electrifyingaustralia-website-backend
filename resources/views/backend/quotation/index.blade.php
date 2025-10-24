@extends('backend.layouts.app')
@section('contents')
    <div class="flex-1 p-3">
        <div class="max-w-[90rem] mx-auto rounded-xl overflow-hidden">
            <div class="flex justify-between items-center mb-3 pl-2 pb-5 mr-6">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-bold text-gray-800">Quotation Question and Option Management</h2>
                    <p class="text-gray-600 mt-1">Manage your quotation settings with questions and options</p>
                </div>

                @if (request()->routeIs('admin.question.all'))
                    <a href="{{ route('admin.question.create') }}"
                        class="bg-teal-600 hover:bg-teal-700 text-white px-2 py-2 rounded-full">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                        </div>
                    </a>
                @endif
                @if (request()->routeIs('admin.question.create') ||
                        request()->routeIs('admin.question.edit') ||
                        request()->routeIs('admin.question.show'))
                    <a href="{{ route('admin.question.all') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-2 rounded-full">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7"></path>
                                <path d="M19 12H5"></path>
                            </svg>
                        </div>
                    </a>
                @endif
                @if (request()->routeIs('admin.quotation.assign-questions') ||
                        request()->routeIs('admin.quotation.show') ||
                        request()->routeIs('admin.quotation.show.assign-questions'))
                    <a href="{{ route('admin.quotation.all') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-2 rounded-full">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7"></path>
                                <path d="M19 12H5"></path>
                            </svg>
                        </div>
                    </a>
                @endif
            </div>
            <!-- Header -->

            <!-- Vertical Tabs Container -->
            <div class="flex !flex-col lg:!flex-row">
                <!-- Tabs Sidebar -->
                <div class=" lg:w-64 lg:!min-h-[45rem] bg-white border rounded-lg border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="space-y-1">
                            <a href="{{ route('admin.quotation.all') }}"
                                class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center hover:!text-teal-500 hover:!bg-teal-50 {{ request()->routeIs('admin.quotation*') ? '!text-teal-500 bg-teal-50' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-quote-icon lucide-quote">
                                    <path
                                        d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z" />
                                    <path
                                        d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z" />
                                </svg>
                                <span class="ml-2">Quotation Section</span>
                            </a>
                            <a href="{{ route('admin.question.all') }}"
                                class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center hover:!text-teal-500 hover:!bg-teal-50 {{ request()->routeIs('admin.question*') ? '!text-teal-500 bg-teal-50' : '' }}"
                                data-tab="question">
                                <svg width="15" height="15" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M11 11H9v-.148c0-.876.306-1.499 1-1.852.385-.195 1-.568 1-1a1.001 1.001 0 00-2 0H7c0-1.654 1.346-3 3-3s3 1 3 3-2 2.165-2 3zm-2 4h2v-2H9v2zm1-13a8 8 0 100 16 8 8 0 000-16z"
                                        fill="#5C5F62" />
                                </svg>
                                <span class="ml-2">Question Section</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex-1 px-6 pb-6">
                    @yield('quotation-section')
                </div>
            </div>
        </div>
    </div>
@endsection
