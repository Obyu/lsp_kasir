@extends('main')
@section('content')

                    <div class="grid grid-cols-1 pb-6">
                        <div class="md:flex items-center justify-between px-[2px]">
                            <h4 class="text-[18px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">Daftar Menu</h4>
                            <a href="{{ route('menu.create') }}" class="bg-blue-600 p-2 text-white rounded-lg flex gap-2 items-center">
                                <i class="bx bx-plus text-lg"></i>
                                <span>Tambah Menu</span>
                            </a>
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
                                                        Nama Menu
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Harga
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menus as $menu)
                                                <tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
                                                    <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{$menu->Namamenu}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{ 'Rp ' . number_format($menu->Harga, 0,',','.') }}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                    <button type="button" onclick="openmodal('{{ $menu->idmenu }}')" class="bx bx-trash-alt text-red-600 text-lg"></button>
                                                       <a href="{{ route('menu.edit', $menu->idmenu) }}" class=" bx bx-pencil"></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="Modalloaded" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                                <div class="flex p-3 text-sm text-red-700 rounded bg-red-50 max-w-md" role="alert">
                                        <i class=" -mt-1 text-xl bx bx-block ltr:mr-3 rtl:ml-3"></i>
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-semibold">Delete</span>
                                            <p class="mt-1">Yakin untuk menghapus item ini?</p>
                                            <div class="flex gap-3 mt-4">
                                                <button onclick="closemodal()" class="font-semibold border-red-700 btn hover:bg-gray-700 hover:text-white" fdprocessedid="3wv9rn">
                                                    Batal
                                                </button>
                                                <form id="deleteForm" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="font-semibold border-red-700 btn hover:bg-red-700 hover:text-white" fdprocessedid="3wv9rn">Hapus</button>
                                                       </form>
                                            </div>
                                        </div>
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
    function openmodal(id) {
        let openmodal = document.getElementById("Modalloaded");
        let modal = document.getElementById("deleteForm");
        modal.action = `/menu/delete/${id}`;
        openmodal.classList.remove("hidden");
    }
    function closemodal() 
    {
        document.getElementById("Modalloaded").classList.add("hidden");
    }
</script>

@endsection