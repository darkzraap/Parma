<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>


    <div class = 'flex justify-center mt-5'>
        <a href={{ route('admin.products.index') }}>
            <div
                class = 'flex items-center justify-center w-24 h-10 text-center text-white bg-blue-500 rounded-xl hover:bg-blue-300'>
                Back
            </div>
        </a>

    </div>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name"
                            value="{{ $product->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- photo -->
                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Photo')" />
                        <x-text-input id="photo" class="block w-full mt-1" type="file" name="photo" />
                        <div class = 'block w-full mt-1'>
                            <h3>Latest Photo Below</h3>
                            <div class = 'flex flex-row items-center gap-5'>
                                <img src={{ Storage::url($product->photo) }} class ='w-[12rem]'>
                                <p class ='text-sm'>{{ $product->photo }}</p>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <!-- price -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Input Price')" />
                        <x-text-input id="price" class="block w-full mt-1" type="number" name="price"
                            :value="old('price', $product->price)" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <!-- text -->
                    <div class="mt-4">
                        <x-input-label for="text" :value="__('Add Text Description')" />
                        <textarea class ='block w-full mt-1' name='about' id='about'>{{ $product->about }} </textarea>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="text" :value="__('Input Category')" />
                        <select class = 'block w-full mt-1'name='category_id' id ='category_id'>
                            @foreach ($Categories as $category)
                                <option value = '{{ $category->id }}'>{{ $category->name }}</option>
                            @endforeach

                        </select>
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
