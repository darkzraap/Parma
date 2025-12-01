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
                            <p>Rp. {{ $productTransaction->total_amount }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400">Date</p>
                            <p>{{ $productTransaction->created_at }}</p>
                        </div>

                        @if ($productTransaction->is_paid == false)
                            <div>
                                <span class="px-4 py-2 text-sm text-white bg-orange-600 rounded-lg">
                                    PENDING
                                </span>
                            </div>
                        @else
                            <div>
                                <span class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg">
                                    Approved
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- LIST PRODUK -->
                <div>
                    <p class="text-sm font-semibold">List of Product</p>
                </div>

                <div class="flex flex-col items-center gap-6 py-3 border rounded-lg">
                    @forelse($productTransaction->transactionDetails as $detail)
                        <img src="{{ Storage::url($detail->product->photo) }}" class="w-12 h-12 bg-gray-100 rounded-lg">

                        <div class="text-center">
                            <p class="font-medium">{{ $detail->product->name }}</p>
                            <p class="text-sm text-gray-400">{{ $detail->product->price }}</p>
                            <p class="text-sm text-gray-400">{{ $detail->product->category->name }}</p>
                        </div>
                    @empty
                    @endforelse
                </div>

                <!-- DETAILS PEMBELI -->
                <div>
                    <p class="text-sm font-semibold">Details & Bukti Payment</p>
                </div>

                <div class="flex justify-center gap-6">
                    <img src="{{ Storage::url($productTransaction->proof) }}" class="w-48 h-64 bg-gray-100 rounded-lg">

                    <div class="flex flex-col gap-2 text-sm text-gray-600">
                        <p>Name : {{ $productTransaction->user->name }}</p>
                        <p>Address : {{ $productTransaction->address }}</p>
                        <p>City : {{ $productTransaction->city }}</p>
                        <p>Post Code : {{ $productTransaction->post_code }}</p>
                        <p>Phone Number : {{ $productTransaction->phone_number }}</p>
                        <p>Notes : {{ $productTransaction->note }}</p>
                    </div>
                </div>

                <!-- APPROVE BUTTON -->
                @role('owner')

                    @if ($productTransaction->is_paid == 0)
                        <div class="flex justify-center">
                            <form action="{{ route('product_transactions.update', $productTransaction) }}" method="POST"
                                onsubmit="return confirm('Are you sure want to approve this order?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                    Approve Order
                                </button>
                            </form>
                        @else
                            <div class="flex ml-[3rem] justify-center">
                                <form action="{{ route('product_transactions.reback', $productTransaction) }}"
                                    method="POST" onsubmit="return confirm('Are you sure want to disapprove this order?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-6 py-3 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-200">
                                        Cancel Order Approve
                                    </button>
                                </form>
                    @endif
                @endrole

                @role('buyer')
                    <a href="https://wa.me/6289659283270" target="_blank"
                        class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Contact Admin
                    </a>
                @endrole
            </div>


        </div>
    </div>
    </div>
</x-app-layout>
