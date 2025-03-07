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
                                                       <a href="{{ route('pelanggan.edit', $pelanggan->idpelanggan) }}" class=" bx bx-pencil"></a>
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