<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Details' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 space-y-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <!-- CARD HEADER TRANSAKSI -->
                <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                    <div class="flex gap-16">
                        <div>
                            <p class="text-sm text-gray-400">Total Transaksi</p>
                            <p>Rp. 1.293.814</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400">Date</p>
                            <p>25 Januari 2025</p>
                        </div>

                        <div>
                            <span class="px-4 py-2 text-sm text-white bg-orange-600 rounded-lg">
                                PENDING
                            </span>
                        </div>
                    </div>
                </div>

                <!-- LIST PRODUK -->
                <div>
                    <p class="text-sm font-semibold">List of Product</p>
                </div>

                <div class="flex items-center justify-center gap-6 py-3 border rounded-lg">
                    <img src="#" class="w-12 h-12 rounded-lg bg-gray-100">

                    <div class="text-center">
                        <p class="font-medium">Panadol</p>
                        <p class="text-sm text-gray-400">Rp 12.500</p>
                        <p class="text-sm text-gray-400">Vitamins</p>
                    </div>
                </div>

                <!-- DETAILS PEMBELI -->
                <div>
                    <p class="text-sm font-semibold">Details & Bukti Payment</p>
                </div>

                <div class="flex justify-center gap-6">
                    <img src="#" class="w-48 h-64 rounded-lg bg-gray-100">

                    <div class="flex flex-col gap-2 text-sm text-gray-600">
                        <p>Name : Ari Arya Putra</p>
                        <p>Address : Permata Cimahi</p>
                        <p>City : Bandung</p>
                        <p>Post Code : -</p>
                        <p>Phone Number : -</p>
                        <p>Notes : -</p>
                    </div>
                </div>

                <!-- APPROVE BUTTON -->
                @role('owner')
                <div class="flex justify-center">
                    <form action="{{ route('product_transactions.update', 1) }}" method="POST"
                        onsubmit="return confirm('Are you sure want to approve this order?')">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                            Approve Order
                        </button>
                    </form>
                    @endrole

                    @role('buyer')
                    <a href = '#' class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                            Contact Admin
                        </a>
                      @endrole
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
