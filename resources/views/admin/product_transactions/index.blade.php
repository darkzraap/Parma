<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Details' }}
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
                            <div
                                class = 'flex items-center h-5 px-3 py-3 text-sm text-white bg-orange-600 rounded-lg w-max '>
                                PENDING</div>
                        </div>
                    </div>

                </div>

                <div>
                    <p class = 'text-sm '>List Of Product</p>
                </div>

                <div class ='flex items-center gap-x-8'>
                    <img src = '#' class = 'w-[3rem]'>
                    <div>
                        <p class = ''>Panadol</p>
                        <p class ='text-sm text-gray-400'>Rp.12500</p>
                    </div>
                    <p class ='text-sm text-gray-400 ml-[8rem]'>Vitamins</p>

                </div>`


                <div>
                    <p class = 'text-sm '>Details & Bukti Payment</p>
                </div>
                <div class ='flex '>
                    <img src ='#' class= 'w-[12rem] h-[16rem]'>

                    <div class ='ml-[3rem] text-sm text-gray-600 gap-y-3 flex flex-col'>
                        <p>Name : Ari Arya Putra </p>
                        <p>Address : Permata Cimahi</p>
                        <p>City : Bandung</p>
                        <p>Post Code : </p>
                        <p>Phone Number : </p>
                        <p>Notes : </p>


                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
