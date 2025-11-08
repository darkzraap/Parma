<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>


    <div class = 'flex justify-center mt-5'>
        <a href={{ route('admin.categories.index') }}>
            <div
                class = 'flex items-center justify-center w-24 h-10 text-center text-white bg-blue-500 rounded-xl hover:bg-blue-300'>
                Back
            </div>
        </a>


        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <form method="POST" action="{{ route('admin.categories.update', $category) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Edit Name" />
                            <x-text-input id="name" class="block w-full mt-1" type="text" name="name"
                                value="{{ $category->name }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Icon -->
                        <div class="mt-4">
                            <x-input-label for="icon" :value="__('Icon')" />
                            <x-text-input id="icon" class="block w-full mt-1" type="file" name="icon"
                                value="{{ $category->icon }}" />
                            <div class='flex items-center justify-center mt-8 bg-black'>
                                <img src={{ Storage::url($category->icon) }}>
                            </div>
                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('+ Edit Category') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</x-app-layout>
