<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <!-- Tombol Create -->
    <div class="flex justify-center mt-5">
        <a href="{{ route('admin.categories.create') }}">
            <div class="flex items-center justify-center h-10 text-white bg-blue-500 w-28 rounded-xl hover:bg-blue-400">
                + Create
            </div>
        </a>
    </div>

    <!-- Daftar Kategori -->
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @forelse ($categories as $category)
                    <div class="flex flex-row items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" class="w-6 h-6">
                            <h4 class="font-medium text-gray-800">{{ $category->name }}</h4>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.categories.edit', $category->slug) }}"
                               class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-500">
                                Edit
                            </a>

                            <!-- Tombol Delete -->
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No categories found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
