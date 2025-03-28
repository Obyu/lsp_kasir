@extends('main')
@section('content')

                    <div class="grid grid-cols-1 pb-6">
                        <div class="md:flex items-center justify-between px-[2px]">
                            <h4 class="text-[18px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">Data Pelanggan</h4>
                            <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 p-2 text-white rounded-lg flex gap-2 items-center">
                                <i class="bx bx-plus text-lg"></i>
                                <span>Tambah Pelanggan</span>
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
                                                        Nama 
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Jenis Kelamin
                                                    </th>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Nomor HP
                                                    </th>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Alamat
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pelanggans as $pelanggan)
                                                <tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
                                                    <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{$pelanggan->Namapelanggan}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{$pelanggan->Jeniskelamin}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{$pelanggan->Nohp}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                        {{$pelanggan->alamat}}
                                                    </td>
                                                    <td class="px-6 py-3.5 dark:text-zinc-100">
                                                       <form action="{{ route('pelanggan.delete', $pelanggan->idpelanggan) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bx bx-trash-alt"></button>
                                                       </form>
                                                       <button onclick="openmodal('{{ $pelanggan->idpelanggan }}','{{ $pelanggan->Namapelanggan }}','{{ $pelanggan->alamat }}','{{ $pelanggan->Nohp }}','{{ $pelanggan->Jeniskelamin }}')" class=" bx bx-pencil"></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div id="modaledit" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                                            <div class="bg-white p-6 rounded-lg flex flex-col w-full max-w-lg">
                                            <form id="editform" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4 w-full">
                                                    <label for="nama"
                                                        class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Nama</label>
                                                    <input name="nama"
                                                        class="w-full placeholder:text-13 text-13 py-1.5 rounded border-gray-100 focus:border focus:border-violet-50 focus:ring focus:ring-violet-500/20 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 placeholder:text-gray-800 dark:text-zinc-100"
                                                        type="text" id="nama" required>
                                                </div>
                                                <div class="mb-4 w-full">
                                                    <label for="laki-laki"
                                                        class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Jenis Kelamin</label>
                                                    <input name="jk"
                                                        type="radio" value="laki-laki" id="jk_laki" required> Laki-laki
                                                    <input name="jk"
                                                        type="radio" value="perempuan" id="jk_perempuan" required> Perempuan
                                                </div>
                                                <div class="mb-4 w-full">
                                                    <label for="telp"
                                                        class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Nomor HP</label>
                                                    <input name="hp"
                                                        class="w-full placeholder:text-13 text-13 py-1.5 rounded border-gray-100 focus:border focus:border-violet-50 focus:ring focus:ring-violet-500/20 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 placeholder:text-gray-800 dark:text-zinc-100"
                                                        type="text" placeholder="Masukkan Harga" id="arga" >
                                                </div>
                                                <div class="mb-4 w-full">
                                                    <label for="alamat"
                                                        class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Alamat</label>
                                                    <input name="alamat"
                                                        class="w-full placeholder:text-13 text-13 py-1.5 rounded border-gray-100 focus:border focus:border-violet-50 focus:ring focus:ring-violet-500/20 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 placeholder:text-gray-800 dark:text-zinc-100"
                                                        type="text" placeholder="Masukkan alamat" id="alamat" >
                                                </div>
                                                <a onclick="closemodal()" class="btn cursor-pointer px-4 py-2 bg-red-600 rounded text-white font-medium">Batal</a>
                                                <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white font-medium">Simpan</button>
                                            </form>
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
                                </div>
                            </div>
                        </div>

<script>
    function openmodal(id, nama, alamat, hp, Jeniskelamin) 
    {
        let editmodal = document.getElementById("modaledit");
        let modal = document.getElementById("editform");
        modal.action = `/pelanggan/update/${id}`;
        document.getElementById("nama").value = nama;
        document.getElementById("alamat").value = alamat;
        document.getElementById("arga").value = hp;
        document.getElementById("jk_laki").checked = Jeniskelamin;
        document.getElementById("jk_perempuan").checked = Jeniskelamin;
        editmodal.classList.remove("hidden");

    }
    function closemodal()
    {
        document.getElementById("modaledit").classList.add("hidden");
    }
</script>
@endsection