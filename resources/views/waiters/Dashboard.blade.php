@extends('main')
@section('content')

<div class="grid grid-cols-3 gap-6 mb-8">
    <!-- Visits -->
    <div class="bg-white p-6 border border-gray-500 rounded-full shadow hover:shadow-md transition mb-2"> 
      <p class="text-sm text-gray-500">Total Pesanan</p>
        <div class="text-4xl font-bold text-gray-800">{{$pesanan ?? 0 }}</div>
        
<!-- #region -->
    </div>

    <!-- Popularity Rate -->
    <div class="bg-white p-6 border border-gray-500 rounded-full shadow hover:shadow-md transition mb-2">
        <div>
            <p class="text-sm text-gray-500 ">Total Meja</p>
            <div class="text-4xl font-bold text-gray-800">{{ $meja}}</div>
        </div>
        
    </div>
   
    <div class="bg-white p-6 border border-gray-500 rounded-full shadow hover:shadow-md transition mb-2">
        <div>
            <p class="text-sm text-gray-500 ">Welcome </p>
            <div class="text-4xl font-serif text-gray-800">{{ $role}}</div>
        </div>
        
    </div>

    <!-- Illustration -->

</div>

<div class="p-8 min-h-screen">

  <div class="bg-green-50 p-4 rounded-lg shadow mb-6 text-center text-white font-semibold ">
    🛎️ Area Kasir
  </div>

  <div class="grid grid-cols-4 gap-4 mb-8">
    @foreach ($mejas as $meja)
    @if ($meja->status === 'terpakai')
    <div class="bg-red-500 p-6 border border-gray-500 text-white text-center py-6 rounded-xl shadow">
        🪑 Meja {{ $meja->NoMeja }}
        <div>
            <p class="text-sm ">{{ $meja->status }}</p>
        </div>
      </div>
    @else
      <button  class="bg-white p-6 border border-gray-500 text-black text-center py-6 rounded-xl shadow hover:bg-green-500 transition cursor-pointer hover:text-white ">
        🪑 Meja {{ $meja->NoMeja }}
        <div>
            <p class="text-sm ">{{ $meja->status }}</p>
        </div>
</button>
      @endif
    @endforeach
  </div>

  <div class="grid grid-cols-2 gap-4">
    <div class="bg-yellow-100 text-center p-6 rounded-xl shadow">🍽️ Dapur</div>
    <div class="bg-blue-100 text-center p-6 rounded-xl shadow">🚻 Toilet</div>
  </div>
</div>
<div id="modalTambah" class="hidden fixed inset-0 bg-gray-900 bg-opacity-20 flex justify-center items-center z-50">
  <div class="bg-white p-6 rounded-2xl shadow-md max-w-3xl w-full">
    <!-- Step Header -->
    <div class="flex justify-between mb-4">
      <div class="font-bold text-gray-700">Step 1: Pelanggan</div>
      <div class="font-bold text-gray-700">Step 2: Pesanan</div>
    </div>

    <!-- Step Content -->
    <div id="step1">
      <h5 class="text-xl font-semibold mb-4">Data Pelanggan</h5>
      <div class="mb-3">
        <label class="font-medium">Mode Input:</label><br>
        <label><input type="radio" name="inputMode" value="select" checked> Pilih</label>
        <label class="ml-4"><input type="radio" name="inputMode" value="manual"> Input Baru</label>
      </div>

      <!-- Pilih Pelanggan -->
      <div id="selectPelanggan" class="mb-3">
        <label class="block">Pilih Pelanggan</label>
        <select class="form-select w-full border p-2" id="pelangganSelect">
          <option>Pilih Pelanggan</option>
          @foreach ($pelanggans as $p)
            <option value="{{ $p->idpelanggan }}">{{ $p->Namapelanggan }} - {{ $p->NoHp }}</option>
          @endforeach
        </select>
      </div>

      <!-- Input Manual -->
      <div id="inputPelanggan" class="hidden">
        <input type="text" placeholder="Nama" class="form-control mb-2 w-full border p-2" id="namaPelanggan">
        <input type="text" placeholder="No HP" class="form-control mb-2 w-full border p-2" id="nohpPelanggan">
        <input type="text" placeholder="Alamat" class="form-control mb-2 w-full border p-2" id="alamatPelanggan">
      </div>

      <div class="text-right">
        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" onclick="nextStep()">Lanjut</button>
      </div>
    </div>

    <div id="step2" class="hidden">
      <h5 class="text-xl font-semibold mb-4">Tambah Pesanan</h5>
      <div class="grid grid-cols-2 gap-4">
        <!-- Kiri -->
        <div>
          <select class="form-select w-full border p-2 mb-2" id="menuSelect">
            <option disabled selected>Pilih Menu</option>
            @foreach ($menus as $menu)
              <option value="{{ $menu->id }}" data-harga="{{ $menu->Harga }}" data-nama="{{ $menu->Namamenu }}">
                {{ $menu->Namamenu }}
              </option>
            @endforeach
          </select>
          <input type="number" id="jumlahMenu" value="1" class="form-control border w-full mb-2 p-2">
          <button class="bg-blue-500 text-white px-4 py-2 rounded w-full" id="tambahPesanan">Tambah</button>
        </div>

        <!-- Kanan -->
        <div>
          <h6 class="mb-2">Daftar Pesanan</h6>
          <ul id="pesananList" class="list-disc list-inside"></ul>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<script>


function modalTambah(mejaId, NoMeja) {
    $('#modalTambah').removeClass('hidden');
    $('#mejaId').val(mejaId);

    $('#step1').removeClass('hidden');
    $('#step2').addClass('hidden');

    $('#pesananList').html('');
    $('#menuSelect').val('');
    $('#jumlahMenu').val(1);
    $('#pelangganSelect').val('');
    $('#namaPelanggan, #nohpPelanggan, #alamatPelanggan').val('');
    $("input[name='modeInput'][value='select']").prop('checked', true);
    $('#inputPelanggan').addClass('hidden');
    $('#pilihPelanggan').removeClass('hidden');
  }

  function nextStep() {
    $('#step1').addClass('hidden');
    $('#step2').removeClass('hidden');
  }

  function tutupModal() {
    $('#modalTambah').addClass('hidden');
  }

  $("input[name='modeInput']").change(function () {
    if ($(this).val() === 'manual') {
      $('#inputPelanggan').removeClass('hidden');
      $('#pilihPelanggan').addClass('hidden');
    } else {
      $('#inputPelanggan').addClass('hidden');
      $('#pilihPelanggan').removeClass('hidden');
    }
  });

  $('#tambahPesanan').click(function () {
    const nama = $('#menuSelect option:selected').data('nama');
    const jumlah = $('#jumlahMenu').val();
    if (!nama) return;

    $('#pesananList').append(`<li>${nama} x ${jumlah}</li>`);
  });
</script>

@endsection
