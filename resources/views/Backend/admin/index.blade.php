@extends('Backend.layouts.app')
@section('contents')
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto ">
        <div class="card">
            <div class="card-body">
                <div id="basic_tables_wrapper" class="dataTables_wrapper dt-tailwindcss">
                    <div class="grid grid-cols-12 lg:grid-cols-12 gap-3">
                        <div class="my-2 col-span-12 overflow-x-auto lg:col-span-12">
                            <table id="basic_tables"
                                class="display stripe group dataTable w-full text-sm align-middle whitespace-nowrap"
                                style="width: 100%;" aria-describedby="basic_tables_info">
                                <thead class="border-b border-slate-200 dark:border-zink-500">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left font-semibold text-slate-900 bg-slate-200/50 dark:text-zink-50 dark:bg-zink-600 w-1/3">
                                            Name
                                        </th>
                                        <th
                                            class="px-4 py-3 text-left font-semibold text-slate-900 bg-slate-200/50 dark:text-zink-50 dark:bg-zink-600 w-1/3">
                                            Email
                                        </th>
                                        <th
                                            class="px-4 py-3 text-left font-semibold text-slate-900 bg-slate-200/50 dark:text-zink-50 dark:bg-zink-600 w-1/3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        class="group-[.stripe]:even:bg-slate-50 group-[.stripe]:dark:even:bg-zink-600 transition-all duration-150 ease-linear group-[.hover]:hover:bg-slate-50 dark:group-[.hover]:hover:bg-zink-600 [&amp;.selected]:bg-custom-500 dark:[&amp;.selected]:bg-custom-500 [&amp;.selected]:text-custom-50 dark:[&amp;.selected]:text-custom-50">
                                        <td
                                            class="p-3 group-[.bordered]:border group-[.bordered]:border-slate-200 group-[.bordered]:dark:border-zink-500 sorting_1">
                                            Airi Satou</td>
                                        <td
                                            class=" p-3 group-[.bordered]:border group-[.bordered]:border-slate-200 group-[.bordered]:dark:border-zink-500">
                                            mdsojibmia694@gmail.com</td>
                                        <td
                                            class=" p-3 group-[.bordered]:border group-[.bordered]:border-slate-200 group-[.bordered]:dark:border-zink-500">
                                            <div class="flex sm:flex-row flex-col gap-2">
                                                <!-- Edit Button -->
                                                <a href=""
                                                    class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm">
                                                    Edit
                                                </a>

                                                <!-- Delete Button -->

                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm text-left">
                                                    Delete
                                                </button>

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
