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
                        <span class="ml-1 text-lg font-medium text-gray-500 md:ml-2">All Packages</span>
                    </div>
                </li>
            </ol>
            <a href="{{ route('admin.package.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                <div class="flex gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    <span>Add Package</span>
                </div>
            </a>
        </div>

        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                @if($packages->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @foreach($packages as $package)
                    <div class="card bg-white rounded-xl overflow-hidden p-6 {{ $package->is_best_deal ? 'border-2 border-teal-500 ring-2 ring-teal-500/20' : '' }}">
                        @if($package->is_best_deal)
                        <div class="absolute top-0 right-0 bg-teal-500 text-white px-3 py-1 text-xs font-bold rounded-bl-lg">
                            Best Deal
                        </div>
                        @endif

                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $package->name }}</h2>
                                    <p class="text-gray-600 max-w-[18rem] line-clamp-3">{{ $package->subtitle }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <a href="{{ route('admin.package.show', $package->id) }}" class="action-btn bg-green-100 hover:bg-green-200 text-green-600 p-2 rounded-full" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('admin.package.edit', $package->id) }}" class="action-btn !bg-blue-100 hover:!bg-blue-200 !text-blue-600 p-2 rounded-full" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                </a>
                                <button onclick="confirmDelete({{ $package->id }})" class="action-btn bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-full" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <h6 class="font-bold pl-2 pb-3">Features</h6>
                            <div class="flex flex-col pl-2 gap-2 text-sm">
                                @forelse($package->features->take(5) as $feature)
                                    <p class="text-gray-700 line-clamp-1">{{ $feature->feature }}</p>
                                @empty
                                    <p class="text-gray-500 italic">No features added yet</p>
                                @endforelse

                                @if($package->features->count() > 5)
                                    <p class="text-teal-600 text-xs">+{{ $package->features->count() - 5 }} more features</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($packages->hasPages())
                <div class="mt-6">
                    {{ $packages->links() }}
                </div>
                @endif

                @else
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open-icon lucide-folder-open"><path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2"/></svg>
                    <h3 class="text-xl font-medium text-gray-700 my-2">No Packages Found</h3>
                    <p class="text-gray-500 mb-2">Get started by creating your first package.</p>
                </div>
                @endif
            </div>
        </div>
        @include('Backend.components.pagination', ['paginator' => $packages])
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black/30 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this package? This action cannot be undone.</p>
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
    form.action = `/admin/package/${id}`;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target.id === 'delete-modal') {
        closeDeleteModal();
    }
});
</script>
@endpush
