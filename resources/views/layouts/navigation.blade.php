<nav x-data="{ open: false }" class="bg-indigo-600 border-b border-gray-100">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}" class="block">
                        <img src="{{ asset('icon/icon.png') }}" alt="Logo" width="128" height="128"
                            class="w-32 h-auto transition-opacity duration-300 opacity-0" loading="eager"
                            decoding="async" onload="this.style.opacity='1'">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-gray-200">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                @role('owner')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')" class="text-white hover:text-gray-200">
                            {{ __('Manage Categories') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')" class="text-white hover:text-gray-200">
                            {{ __('Manage Products') }}
                        </x-nav-link>
                    </div>
                @endrole

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('product_transactions.index')" :active="request()->routeIs('product_transactions.index')" class="text-white hover:text-gray-200">
                        {{ Auth::user()->hasRole('owner') ? __('Manage Orders') : __('My Transactions') }}
                    </x-nav-link>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('front.index')" :active="request()->routeIs('front.index')" class="text-white hover:text-gray-200">
                            {{ __('Store') }}
                        </x-nav-link>
                    </div>

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-indigo-600 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-indigo-800 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-indigo-100 transition duration-150 ease-in-out rounded-md hover:text-white hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden bg-indigo-700 sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-white border-indigo-300 focus:border-indigo-100 focus:bg-indigo-600 focus:text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- FIXED: Added Owner Links for Mobile --}}
            @role('owner')
                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')"
                    class="text-white border-indigo-300 focus:border-indigo-100 focus:bg-indigo-600 focus:text-white">
                    {{ __('Manage Categories') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')"
                    class="text-white border-indigo-300 focus:border-indigo-100 focus:bg-indigo-600 focus:text-white">
                    {{ __('Manage Products') }}
                </x-responsive-nav-link>
            @endrole

            {{-- FIXED: Added Transaction Links for Mobile --}}
            <x-responsive-nav-link :href="route('product_transactions.index')" :active="request()->routeIs('product_transactions.index')"
                class="text-white border-indigo-300 focus:border-indigo-100 focus:bg-indigo-600 focus:text-white">
                {{ Auth::user()->hasRole('owner') ? __('Manage Orders') : __('My Transactions') }}



                <x-responsive-nav-link :href="route('front.index')" :active="request()->routeIs('front.index')"
                    class="text-white border-indigo-300 focus:border-indigo-100 focus:bg-indigo-600 focus:text-white">
                    {{ __('Store') }}
                </x-responsive-nav-link>


            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-indigo-500">
            <div class="px-4">
                <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-indigo-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-indigo-100 hover:text-white hover:bg-indigo-600">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        class="text-indigo-100 hover:text-white hover:bg-indigo-600"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
