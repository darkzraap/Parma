<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

    
        <!-- Icon -->
        <div>
            <x-input-label for="icon" :value="__('icon')" />
            <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" required autofocus autocomplete="icon" />
            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('+ Add New Category') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


            </div>
        </div>
    </div>
</x-app-layout>
