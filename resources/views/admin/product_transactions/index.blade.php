<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ Auth::user()->hasRole('owner') ? __('Manage Orders') : __('My List Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col p-6 space-y-4 bg-white shadow-sm sm:rounded-lg">

                {{-- DESKTOP VIEW: Table (Visible on md screens and up) --}}
                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-gray-100 border-b">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Total Transaksi</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($product_transactions as $index => $transaction)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $transaction->created_at->format('d M Y') }}
                                        <div class="text-xs text-gray-400">{{ $transaction->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($transaction->is_paid)
                                            <span
                                                class="px-3 py-1 text-xs font-medium text-white bg-green-600 rounded-full">
                                                SUCCESS
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 text-xs font-medium text-white bg-orange-600 rounded-full">
                                                PENDING
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('product_transactions.show', $transaction) }}"
                                            class="px-4 py-2 text-xs font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500">
                                        Belum tersedia transaksi terbaru
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- MOBILE VIEW: Cards (Visible on small screens only) --}}
                <div class="grid grid-cols-1 gap-4 md:hidden">
                    @forelse($product_transactions as $index => $transaction)
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                            {{-- Header: ID and Date --}}
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-gray-500">
                                    #{{ $index + 1 }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $transaction->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>

                            {{-- Main Info: Amount and Status --}}
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-xs text-gray-400">Total</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    @if ($transaction->is_paid)
                                        <span
                                            class="px-2 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-md">
                                            SUCCESS
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-bold text-orange-700 bg-orange-100 rounded-md">
                                            PENDING
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Action: Full width button --}}
                            <a href="{{ route('product_transactions.show', $transaction) }}"
                                class="block w-full py-2 text-sm font-semibold text-center text-white bg-blue-600 rounded-lg active:bg-blue-700">
                                View Details
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center text-gray-500">
                            Belum tersedia transaksi terbaru
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
