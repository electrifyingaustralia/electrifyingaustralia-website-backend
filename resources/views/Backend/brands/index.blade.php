@extends('Backend.layouts.app')
@section('contents')
    <div class="mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <!-- Breadcrumb -->
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:!text-teal-600">
                            <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">All Brands</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Add User Button -->
            <a href="{{ route('admin.brands.create') }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Brand
            </a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Logo</th>
                    <th class="px-6 py-3">Brand Name</th>
                    <th class="px-6 py-3">Link</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($brands as $brand)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <div class="flex items-center">
                                    @if($brand->logo)
                                        <img class="h-15 w-20 rounded-lg object-cover mr-3"
                                            src="{{ asset('storage/' . $brand->logo) }}"
                                            alt="{{ $brand->logo }}">
                                    @else
                                        <div class="h-5 w-5 flex items-center justify-center mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        </div>
                                    @endif
                                    {{-- <div>
                                        {{ $brand->name }}
                                    </div> --}}
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $brand->name }}</td>
                            <td class="px-6 py-4"><a href="{{ $brand->link }}" target="_blank">{{ $brand->link }}</a></td>
                            <td class="px-6 py-8 flex gap-x-2">
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-500 hover:fill-blue-700 ml-2.5"
                                        viewBox="0 0 348.882 348.882">
                                        <path
                                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                        data-original="#000000" />
                                        <path
                                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                        data-original="#000000" />
                                    </svg>
                                </a>
                                <button class="text-red-500 hover:text-red-700" type="button" onclick=" openDeleteModal({{ $brand->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                        <path
                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                        data-original="#000000" />
                                        <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                        data-original="#000000" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center font-bold text-gray-500">
                                No brands found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!-- Delete Modal Content -->
    <div id="deleteModal"
        class="fixed inset-0 bg-black/30 bg-opacity-50 hidden flex items-start justify-center z-50">

        <div class="bg-white w-full max-w-md mx-auto mt-40 rounded-2xl shadow-lg transform transition-transform duration-300 -translate-y-full"
            id="deleteModalContent">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800">Confirm Delete</h2>
                <p class="mt-2 text-gray-600">Are you sure you want to delete this brand? This action cannot be undone.</p>

                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 !bg-red-600 text-white rounded-lg !hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let currentDeleteId = null;

    function openDeleteModal(id) {
        currentDeleteId = id;
        const form = document.getElementById('deleteForm');
        form.action = `/admin/brands/${id}`; // Adjust route as needed
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target.id === 'deleteModal') {
            closeDeleteModal();
        }
});
</script>
@endpush
