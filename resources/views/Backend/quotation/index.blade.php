@extends('Backend.layouts.app')
@push('styles')
        <style>
        .tab-active {
            background-color: #F0FDFA;
            color: #00BBA7;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
        }
    </style>
@endpush
@section('contents')
    <div class="flex-1 p-3">
        <div class="max-w-[90rem] mx-auto  rounded-xl overflow-hidden">
            <div class="mb-3 pl-2 pb-5">
                <h2 class="text-2xl font-bold text-gray-800">Quotation Management</h2>
                <p class="text-gray-600 mt-1">Manage your quotation settings with questions and options</p>
            </div>
            <!-- Header -->

            <!-- Vertical Tabs Container -->
            <div class="flex !flex-col lg:!flex-row">
                <!-- Tabs Sidebar -->
                <div class=" lg:w-64 lg:!min-h-[45rem] bg-white border rounded-lg border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="space-y-1">
                            <a href="{{ route('admin.quotation.all') }}" class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center tab-active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote-icon lucide-quote"><path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"/><path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"/></svg>
                                <span class="ml-2">Quotation Section</span>
                            </a>
                            <button class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center" data-tab="question">
                                <svg width="15" height="15" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11 11H9v-.148c0-.876.306-1.499 1-1.852.385-.195 1-.568 1-1a1.001 1.001 0 00-2 0H7c0-1.654 1.346-3 3-3s3 1 3 3-2 2.165-2 3zm-2 4h2v-2H9v2zm1-13a8 8 0 100 16 8 8 0 000-16z" fill="#5C5F62"/></svg>
                                <span class="ml-2">Question Section</span>
                            </button>
                            <button class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center" data-tab="content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-question-mark-icon lucide-file-question-mark"><path d="M12 17h.01"/><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z"/><path d="M9.1 9a3 3 0 0 1 5.82 1c0 2-3 3-3 3"/></svg>
                                <span class="ml-2">Question to Quotation</span>
                            </button>
                            <button class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center" data-tab="settings">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </button>
                            <button class="tab-button w-full text-left px-4 py-3 rounded-lg flex items-center" data-tab="analytics">
                                <i class="fas fa-chart-line mr-3"></i>
                                Analytics
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tab Content Area -->
                <div class="flex-1 p-6">
                    <!-- Quotation Section Tab -->
                    {{-- @include('backend.quotation.sections.quotation-section') --}}
                    @yield('quotation-section')
                    <!-- Users Tab -->
                    {{-- @include('backend.quotation.sections.question-section')


                    <!-- Content Tab -->
                    <div id="content-tab" class="tab-content">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Content Management</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-blue-50 p-5 rounded-lg border border-blue-100 flex items-center">
                                <div class="bg-blue-100 p-4 rounded-full mr-4">
                                    <i class="fas fa-file-text text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-bold text-gray-800">128</h4>
                                    <p class="text-sm text-blue-600">Blog Posts</p>
                                </div>
                            </div>

                            <div class="bg-green-50 p-5 rounded-lg border border-green-100 flex items-center">
                                <div class="bg-green-100 p-4 rounded-full mr-4">
                                    <i class="fas fa-tags text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-bold text-gray-800">42</h4>
                                    <p class="text-sm text-green-600">Categories</p>
                                </div>
                            </div>

                            <div class="bg-purple-50 p-5 rounded-lg border border-purple-100 flex items-center">
                                <div class="bg-purple-100 p-4 rounded-full mr-4">
                                    <i class="fas fa-comments text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-bold text-gray-800">256</h4>
                                    <p class="text-sm text-purple-600">Comments</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="px-5 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h4 class="text-lg font-semibold text-gray-800">Recent Posts</h4>
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
                                    <i class="fas fa-plus mr-2"></i>Add New
                                </button>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="p-5 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium">Getting Started with Laravel</p>
                                        <p class="text-sm text-gray-600">Published on June 12, 2023 • 5 min read</p>
                                    </div>
                                    <div>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Published</span>
                                    </div>
                                </div>
                                <div class="p-5 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium">Advanced Tailwind CSS Techniques</p>
                                        <p class="text-sm text-gray-600">Draft • Last edited June 10, 2023</p>
                                    </div>
                                    <div>
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Draft</span>
                                    </div>
                                </div>
                                <div class="p-5 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium">Building Responsive Layouts</p>
                                        <p class="text-sm text-gray-600">Scheduled for June 15, 2023 • 8 min read</p>
                                    </div>
                                    <div>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Scheduled</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div id="settings-tab" class="tab-content">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">System Settings</h3>

                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mb-8">
                            <div class="px-5 py-4 border-b border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-800">General Settings</h4>
                            </div>
                            <div class="p-5">
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Title</label>
                                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="My Admin Dashboard">
                                </div>
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Description</label>
                                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" rows="3">A modern admin dashboard built with Tailwind CSS</textarea>
                                </div>
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                        <option>(UTC) Coordinated Universal Time</option>
                                        <option>(EST) Eastern Standard Time</option>
                                        <option selected>(PST) Pacific Standard Time</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Tab -->
                    <div id="analytics-tab" class="tab-content">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Analytics Overview</h3>

                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mb-8">
                            <div class="px-5 py-4 border-b border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-800">Traffic Overview</h4>
                            </div>
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h5 class="text-lg font-semibold text-gray-800">24,589</h5>
                                        <p class="text-sm text-gray-600">Total visitors this month</p>
                                    </div>
                                    <div class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        +12.5%
                                    </div>
                                </div>

                                <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center mb-4">
                                    <p class="text-gray-500">Chart would be displayed here</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <p class="text-sm text-blue-600">Avg. Session Duration</p>
                                        <h5 class="text-lg font-semibold text-gray-800">2m 35s</h5>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <p class="text-sm text-green-600">Bounce Rate</p>
                                        <h5 class="text-lg font-semibold text-gray-800">42.3%</h5>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <p class="text-sm text-purple-600">New Sessions</p>
                                        <h5 class="text-lg font-semibold text-gray-800">76.8%</h5>
                                    </div>
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <p class="text-sm text-yellow-600">Pageviews</p>
                                        <h5 class="text-lg font-semibold text-gray-800">58.4K</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const tabId = button.getAttribute('data-tab');

                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('tab-active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked button and corresponding content
                    button.classList.add('tab-active');
                    document.getElementById(`${tabId}-tab`).classList.add('active');
                });
            });
        });
    </script>

@endpush
