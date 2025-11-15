<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{Auth::user()->hasRole('owner')?_('Manage Orders'):_('My List Transaction')}}
        </h2>
    </x-slot>

    <!-- Tombol Create -->


    <!-- Daftar Product -->
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <div class="flex flex-row items-center justify-center gap-6 p-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center gap-x-16">

                        <div>
                        <p class ='text-sm text-gray-400'>Total Transaksi</p>
                        <p>RP. 1293814</p>
                        </div>


                        <div>
                        <p class ='text-sm text-gray-400'>Date</p>
                        <p>25 Januari 2025</p>
                        </div>

                        <div>
                            <div class = 'flex items-center h-5 px-3 py-3 text-sm text-white bg-orange-600 rounded-lg w-max '>PENDING</div>
                        </div>


                        <div class="flex items-center gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('product_transactions.show', 1) }}"
                                class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-indigo-500">
                                View Details
                            </a>

                        </div>
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>
