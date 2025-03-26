@extends('main')
@section('content')

            <div class="container-fluid px-[0.625rem]">

                <div class="grid grid-cols-1 pb-6">
                    <div class="md:flex items-center justify-between px-[2px]">
                        <h4 class="text-[18px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">Form
                            Tambah pesanan</h4>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                                <li class="inline-flex items-center">
                                    <a href="{{ route('pesanan.index') }}"
                                        class="inline-flex items-center text-sm text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                        Data pesanan
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center rtl:mr-2">
                                        <i
                                            class="font-semibold text-gray-600 align-middle far fa-angle-right text-13 rtl:rotate-180 dark:text-zinc-100"></i>
                                        <a href="#"
                                            class="text-sm font-medium text-gray-500 ltr:ml-2 rtl:mr-2 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">
                                            Tambah pesanan</a>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="grid grid-cols-1">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-header">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="col-span-12 lg:col-span-6">
                                    @foreach ($mejas as $meja)
                                    <form action="{{ route('pesanan.store', $meja->id) }}" method="POST">
                                        @endforeach
                                        @csrf
                                        <div class="mb-4">
                                            <label for="nama"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Menu</label>
                                                @foreach ($cart as $item)
                                                    <li>
                                                        {{ $item['menu'] }} - {{ $item['jumlah'] }} 
                                                    </li>
                                                @endforeach
                                            <label for="nama"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Nama Pelanggan</label>
                                                <select name="pelanggan" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-transparent py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" fdprocessedid="5vhotj">
                                                    <option>Silahkan PIlih Pelanggan</option>
                                                    @foreach ($pelanggans as $pelanggan)
                                                    <option value="{{ $pelanggan->idpelanggan }}">{{ $pelanggan->Namapelanggan }}</option>
                                                    @endforeach
                                                </select>
                                            <label for="nama"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Nomor Meja</label>
                                                <select name="meja" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-transparent py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" fdprocessedid="5vhotj">
                                                    <option>Silahkan PIlih Menu</option>
                                                    @foreach ($mejas as $meja)
                                                    <option value="{{ $meja->id }}">{{ $meja->NoMeja }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                      <button type="submit" class="px-4 py-2 bg-blue-600 rounded-full text-white font-medium">Simpan</button>
                                    </form>
                                    <button onclick="openmodal()" class="px-4 py-2 bg-blue-400 rounded-full text-white font-medium">Pesanan +</button>
                                        
                                    <div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                                        <div class="flex justify-between items-center border-b pb-2">
                                            <h2 class="text-lg font-semibold">Tambah Pesanan</h2>
                                            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                    <form action="{{ route('pesanan.addcart' ) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="nama"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Menu</label>
                                                <select name="menu" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-transparent py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" fdprocessedid="5vhotj">
                                                    <option>Silahkan PIlih Menu</option>
                                                    @foreach ($menus as $menu)
                                                    <option value="{{ $menu->idmenu }}">{{ $menu->Namamenu }}</option>
                                                    @endforeach
                                                </select>
                                            <label for="jumlah"
                                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Jumlah</label>
                                            <input name="jumlah"
                                                class="w-full placeholder:text-13 text-13 py-1.5 rounded border-gray-100 focus:border focus:border-violet-50 focus:ring focus:ring-violet-500/20 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 placeholder:text-gray-800 dark:text-zinc-100"
                                                type="number" placeholder="Masukkan Jumlah Pesanan" id="jumlah" required>
                                            </div>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 rounded-full text-white font-medium">Simpan</button>
                                    </form>
                                        <div class="mt-6 flex justify-end">
                                            <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
       <script>
        function openmodal()
        {
            document.getElementById("myModal").classList.remove("hidden");
        }
        function closeModal()
        {
            document.getElementById("myModal").classList.add("hidden");
        }
       </script>