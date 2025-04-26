@extends('main')
@section('content')
            <div class="container-fluid px-[0.625rem]">

                <div class="grid grid-cols-1 pb-6">
                    <div class="md:flex items-center justify-between px-[2px]">
                        <h4 class="text-[18px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">Form
                            Edit Pesanan {{ $pesanan->pelanggan->Namapelanggan }}</h4>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                                <li class="inline-flex items-center">
                                    <a href="{{ route('menu.index') }}"
                                        class="inline-flex items-center text-sm text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                        Pesanan {{ $pesanan->pelanggan->Namapelanggan }}
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center rtl:mr-2">
                                        <i
                                            class="font-semibold text-gray-600 align-middle far fa-angle-right text-13 rtl:rotate-180 dark:text-zinc-100"></i>
                                        <a href="#"
                                            class="text-sm font-medium text-gray-500 ltr:ml-2 rtl:mr-2 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">Daftar Pesanan</a>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="grid grid-cols-1">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-header">
                            @if ($errors->any())
                                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mt-2 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="col-span-12 lg:col-span-6">
                                    <form action="{{ route('pesanan.update', [$pesanan->idpesanan, $pesanan->pelanggan->idpelanggan]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                        <label for="nama"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Nomor Meja</label>
                                                <select name="menu" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-transparent py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" fdprocessedid="5vhotj">
                                                    <option>{{ $pesanan->menu->Namamenu }}</option>
                                                    @foreach ($menus as $menu)
                                                    <option value="{{ $menu->idmenu }}">{{ $menu->Namamenu }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    
                                        <div class="mb-4">
                                            <label for="telp"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Jumlah</label>
                                            <input name="jumlah"
                                                class="w-full placeholder:text-13 text-13 py-1.5 rounded border-gray-100 focus:border focus:border-violet-50 focus:ring focus:ring-violet-500/20 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 placeholder:text-gray-800 dark:text-zinc-100"
                                                type="text" placeholder="{{ $pesanan->jumlah }}" id="arga" required>
                                        </div>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white font-medium">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                          document.addEventListener('DOMContentLoaded', function () {
                            const hargaInput = document.getElementById('Harga');
                            const form = document.querySelector('form'); 

                            if (hargaInput) {
                                hargaInput.addEventListener('input', function(event) {
                                    let value = event.target.value;
                                    value = value.replace(/[^\d,]/g, '');
                                    if (value) {
                                        value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                    }
                                    event.target.value = value;
                                });

                                form.addEventListener('submit', function(event) {
                                    let value = hargaInput.value;
                                    value = value.replace(/[^\d]/g, '');
                                    hargaInput.value = value;
                                });
                            }
                        });
                        </script>
            @endsection