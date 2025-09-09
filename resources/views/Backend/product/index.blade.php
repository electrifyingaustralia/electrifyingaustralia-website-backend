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
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">All Products</span>
                    </div>
                </li>
            </ol>
            <a href="{{ route('admin.product.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                <div class="flex gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    <span>Add Product</span>
                </div>
            </a>
        </div>
        <!-- Search -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('admin.product.all') }}" method="GET">
                <div class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full p-2 border !border-gray-300 rounded-lg">
                    </div>
                    <button type="submit" class="!bg-black text-white px-4 py-2 rounded-lg">
                        <div class="flex justify-center items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-1" width="20" height="20" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                            <span>Search</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Media</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Brand</th>
                    <th class="px-6 py-3">Model</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($products  as $product)

                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900 max-w-[2rem]">
                                <div class="flex items-center">
                                    @if($product->media_url)
                                    <img src="{{ $product->media_url }}" class="w-20 h-10 object-scale-down rounded">
                                    @else
                                        <div class="w-20 h-10 bg-gray-200 rounded flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera-icon lucide-camera"><path d="M13.997 4a2 2 0 0 1 1.76 1.05l.486.9A2 2 0 0 0 18.003 7H20a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1.997a2 2 0 0 0 1.759-1.048l.489-.904A2 2 0 0 1 10.004 4z"/><circle cx="12" cy="13" r="3"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-[15rem] truncate">{{ $product->name }}</td>
                            <td class="px-6 py-4 max-w-[15rem] truncate">{{ $product->brand->name }}</td>
                            <td class="px-6 py-4 max-w-[15rem] truncate">{{ $product->model_number }}</td>
                            <td class="px-6 py-4">
                                @if($product->is_active == 1)
                                    <span class="text-green-600 font-bold">Active</span>
                                @else
                                    <span class="text-red-600 font-bold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-8 flex items-center gap-x-2">
                                <a href="{{ route('admin.product.show', $product->id) }}"
                                    class="text-green-500 hover:text-green-700 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 fill-green-500 hover:fill-green-700"
                                        viewBox="0 0 24 24">
                                        <path d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12c-4.411 0-7.757-3.134-9.223-5
                                                1.466-1.866 4.812-5 9.223-5s7.757 3.134 9.223 5c-1.466 1.866-4.812 5-9.223 5z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-500 hover:fill-blue-700"
                                        viewBox="0 0 348.882 348.882">
                                        <path
                                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                        data-original="#000000" />
                                        <path
                                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                        data-original="#000000" />
                                    </svg>
                                </a>
                                <button class="text-red-500 hover:text-red-700" type="button" onclick="confirmDelete({{ $product->id }})">
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
                            <td colspan="6" class="px-6 py-4 text-center font-medium text-gray-700">
                                <div class="flex flex-col items-center justify-center gap-x-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open-icon lucide-folder-open"><path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2"/></svg>
                                    <span class="pt-2 text-lg">No Product found.</span>
                                </div>
                                <span class="text-gray-500">Upload your first file to get started!</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this brand? This action cannot be undone.</p>
        <div class="flex justify-end gap-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 !bg-red-600 text-white rounded-lg hover:!bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    const form = document.getElementById('delete-form');
    form.action = `/admin/product/${id}`;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
}
</script>
@endpush
