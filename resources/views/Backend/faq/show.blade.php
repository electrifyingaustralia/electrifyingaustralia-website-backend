@extends('Backend.layouts.app')
@section('contents')
<div class="flex-1 p-3">
    <div class="max-w-[90rem] mx-auto">
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
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">View FAQ</span>
                    </div>
                </li>
            </ol>
            <a href="{{ route('admin.faq.all') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                <div class="flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    <span>Back to FAQ's</span>
                </div>
            </a>
        </div>
        <div class="flex flex-col lg:!flex-row gap-6">
            <div class="w-full lg:!w-2/3">
                <!-- Sticky Headers Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 w-3/5">Questions</th>
                                    <th class="px-4 py-3 w-3/5">Answer</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4">
                                            <div class="max-w-2xl" title="{{ $faq->question }}">
                                                {{ $faq->question }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="max-w-2xl" title="{{ $faq->answer }}">
                                                {{ $faq->answer }}
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="w-full lg:!w-1/3">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class=" text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 w-3/5">Type</th>
                                    <th class="px-4 py-3 w-3/5">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4">
                                            <div class="max-w-2xl" title="{{ $faq->type->name }}">
                                                {{ $faq->type->name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="max-w-2xl font-bold {{ $faq->is_active == 1 ? 'text-green-500' : 'text-red-500' }}" title="{{ $faq->is_active }}">
                                                {{ $faq->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
        </div>
    </div>

</div>
@endsection
