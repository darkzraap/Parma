<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ Auth::user()->hasRole('owner') ? _('Manage Orders') : _('My List Transaction') }}
        </h2>
    </x-slot>

    <!-- Tombol Create -->


    <!-- Daftar Product -->
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">




                <div class="overflow-x-auto">
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

                                    <td class="px-4 py-3">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $transaction->created_at->format('d M Y - H:i') }}
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
                                            class="px-4 py-2 text-xs font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">
                                        Belum tersedia transaksi terbaru
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</x-app-layout>
