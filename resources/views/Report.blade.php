@extends('main')
@section('content')

                    <div class="grid grid-cols-1 pb-6">
                        <div class="md:flex items-center justify-between px-[2px]">
                            <h4 class="text-[18px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">Data Meja</h4>
                        </div>
                    </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="dark:bg-zinc-800 dark:border-zinc-600">
                                <div class="card-body">
                                    <div class="relative overflow-x-auto w-full">
                                        <table class="w-full text-sm text-left text-gray-500 ">
                                            <thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        No
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Kode Pesanan
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Total
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Bayar
                                                    </th>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Kembalian
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Generate
                                                    </th>
                                                    </th>
                                                   
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksis as $transaksi)
                                                <tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
                                                    <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{$transaksi->pesanan->kode_pesanan}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{'Rp ' . number_format($transaksi->total, 0, ',','.')}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{'Rp ' . number_format($transaksi->bayar, 0,',','.')}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                    @if ($transaksi->kembalian > 0)
                                                        {{ 'Rp ' . number_format($transaksi->kembalian, 0,',','.') }}
                                                    @elseif ($transaksi->Kurang > 0)
                                                        {{'Rp -' . number_format($transaksi->Kurang,0,',','.') }}
                                                    @endif
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                       <form action="#" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bx bx-trash-alt"></button>
                                                       </form>
                                                       <a href="#" class=" bx bx-pencil"></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


@endsection