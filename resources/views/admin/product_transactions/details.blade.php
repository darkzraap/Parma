<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Details Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 space-y-6 overflow-hidden bg-white shadow-sm sm:p-6 sm:rounded-lg">

                <div class="p-4 border rounded-lg bg-gray-50 md:bg-white hover:bg-gray-50">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                        {{-- Info Group --}}
                        <div class="flex flex-col gap-4 md:flex-row md:gap-16">
                            <div>
                                <p class="text-xs tracking-wider text-gray-400 uppercase">Total Transaksi</p>
                                <p class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($productTransaction->total_amount, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs tracking-wider text-gray-400 uppercase">Date</p>
                                <p class="font-medium text-gray-700">
                                    {{ $productTransaction->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        {{-- Status Badge --}}
                        <div>
                            @if (!$productTransaction->is_paid)
                                <span
                                    class="inline-block w-full px-4 py-2 text-sm font-bold text-center text-white bg-orange-500 rounded-full md:w-auto">
                                    PENDING
                                </span>
                            @else
                                <span
                                    class="inline-block w-full px-4 py-2 text-sm font-bold text-center text-white bg-green-600 rounded-full md:w-auto">
                                    APPROVED
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">List of Product</h3>

                    <div class="flex flex-col gap-4">
                        @forelse($productTransaction->transactionDetails as $detail)
                            <div class="flex items-center gap-4 p-3 bg-white border rounded-lg shadow-sm">
                                {{-- Product Image --}}
                                <div class="flex-shrink-0">
                                    <img src="{{ Storage::url($detail->product->photo) }}"
                                        class="object-cover w-16 h-16 bg-gray-100 rounded-lg">
                                </div>

                                {{-- Product Details --}}
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 line-clamp-1">{{ $detail->product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $detail->product->category->name }}</p>
                                    <p class="text-sm font-medium text-blue-600">
                                        Rp {{ number_format($detail->product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="py-4 text-center text-gray-500">No products found.</p>
                        @endforelse
                    </div>
                </div>

                <div>
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Payment & Delivery</h3>

                    <div class="flex flex-col items-start gap-6 md:flex-row">

                        {{-- Proof Image (Full width on mobile, side on desktop) --}}
                        <div class="w-full md:w-1/3">
                            <div class="relative overflow-hidden border border-gray-200 rounded-xl">
                                <img src="{{ Storage::url($productTransaction->proof) }}"
                                    class="object-contain w-full h-auto bg-gray-50" alt="Proof of payment">
                                <p class="py-2 text-xs text-center text-gray-400">Proof of Payment</p>
                            </div>
                        </div>

                        {{-- Customer Details --}}
                        <div class="w-full md:w-2/3">
                            <div
                                class="grid grid-cols-1 gap-4 p-4 text-sm border border-gray-100 bg-gray-50 rounded-xl">
                                <div>
                                    <p class="text-xs text-gray-400">Name</p>
                                    <p class="font-semibold">{{ $productTransaction->user->name }}</p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-400">Full Address</p>
                                    <p class="font-medium">
                                        {{ $productTransaction->address }}, {{ $productTransaction->city }}
                                        <br>
                                        <span class="text-gray-500">{{ $productTransaction->post_code }}</span>
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-400">Phone</p>
                                        <p class="font-medium">{{ $productTransaction->phone_number }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">City</p>
                                        <p class="font-medium">{{ $productTransaction->city }}</p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-400">Notes</p>
                                    <p class="italic text-gray-600">
                                        "{{ $productTransaction->note ?? 'No notes' }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t">
                    @role('owner')
                        @if ($productTransaction->is_paid == 0)
                            <form action="{{ route('product_transactions.update', $productTransaction) }}" method="POST"
                                onsubmit="return confirm('Are you sure want to approve this order?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="w-full md:w-auto px-6 py-4 text-base font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 shadow-lg transition-all transform hover:scale-[1.02]">
                                    Approve Order Now
                                </button>
                            </form>
                        @else
                            <form action="{{ route('product_transactions.reback', $productTransaction) }}" method="POST"
                                onsubmit="return confirm('Are you sure want to disapprove this order?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="w-full px-6 py-4 text-base font-bold text-white transition-all bg-red-600 rounded-full shadow-lg md:w-auto hover:bg-red-700">
                                    Cancel Approval
                                </button>
                            </form>
                        @endif
                    @endrole

                    @role('buyer')
                        <a href="https://wa.me/6289659283270" target="_blank"
                            class="flex items-center justify-center w-full px-6 py-4 text-base font-bold text-white bg-green-500 rounded-full shadow-lg md:w-auto hover:bg-green-600">
                            Contact Admin via WhatsApp
                        </a>
                    @endrole
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
