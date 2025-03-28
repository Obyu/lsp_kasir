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
                                <form action="{{ route('transaction.report') }}" method="GET" class="mb-6">
                                    <div class="flex flex-wrap gap-2 items-center">
                                        <select name="filter" id="filter" class="p-2 w-32 border  rounded bg-white dark:bg-zinc-700 dark:text-white">
                                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua</option>
                                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                                            <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                                            <option value="last_month" {{ request('filter') == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                                            <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>Tahun</option>
                                        </select>

                                        <input type="number" name="year" id="year" class="p-2 border rounded bg-white dark:bg-zinc-700 dark:text-white hidden" placeholder="Masukkan Tahun" value="{{ request('year') }}">

                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-600 transition">Filter</button>
                                        
                                        <button onclick="printTable()" class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                            Print
                                        </button>
                                    </div>
                                </form>
                                    <div id="print-area" class="relative overflow-x-auto w-full">
                                        <table class="w-full text-sm text-left text-gray-500 ">
                                            <thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        No
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Nama Pelanggan
                                                    </th>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Total
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Bayar
                                                    </th>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Kembalian / Kurang
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
                                                        {{$transaksi->pelanggan->Namapelanggan}}
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
                                                        {{'Rp - ' . number_format($transaksi->Kurang,0,',','.') }}
                                                    @endif
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                      <a href="{{ route('transaction.print', $transaksi->pelanggan->idpelanggan) }}"><i class=" bx bx-printer"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if (session('success'))
                                        <div id="alert-box" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                                        <div class="relative px-6 py-3 text-center bg-green-100 border border-green-200 rounded alert-dismissible" role="alert">
                                            <button onclick="this.parentElement.remove()" class="absolute text-lg alert-close ltr:ml-auto rtl:mr-auto text-zinc-500 top-2 right-3" fdprocessedid="8n73i"><i class="mdi mdi-close"></i></button>
                                           <div class="mt-2 mb-4">
                                            <i class="text-6xl text-green-500 mdi mdi-check-all"></i>
                                           </div>
                                        <h5 class="text-green-500">Success</h5>
                                        <p class="mt-1 mb-4 text-green-800">{{ session('success') }}</p>
                                        </div>
                                        </div>
                                        <script>
                                            function closealert()
                                            {
                                                document.getElementById("alert-box").remove();
                                            }
                                            setTimeout(closealert, 2000);
                                        </script>
                                        @endif  
                        </div>

                        <script>
                            function printTable()
                            {
                                let print = document.getElementById('print-area').innerHTML;
                                let origin = document.body.innerHTML;

                                document.body.innerHTML = print;
                                window.print();
                                document.body.innerHTML = origin;
                                location.reload();
                            }
                            document.getElementById('filter').addEventListener('change', function () {
                                let yearInput = document.getElementById('year');

                                if (this.value === 'year') {
                                    yearInput.classList.remove('hidden');
                                } else {
                                    yearInput.classList.add('hidden');
                                }
                            });
                        </script>
@endsection
