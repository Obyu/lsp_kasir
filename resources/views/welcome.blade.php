@extends('main')
@section('content')


<div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Selamat Datang {{ $role }}</h1>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('pesanan.create') }}" class="bg-blue-600 text-white p-4 rounded-lg shadow-md flex items-center justify-between hover:bg-blue-800 transition">
                <span class="text-lg font-semibold">Tambah Pesanan</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
            </a>
            <a href="{{ route('pelanggan.create') }}" class="bg-green-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between hover:bg-green-600 transition">
                <span class="text-lg font-semibold">Tambah Pelanggan</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M16 14a4 4 0 01-8 0m8-4a4 4 0 11-8 0m12 10H4a2 2 0 00-2 2v2h20v-2a2 2 0 00-2-2z"></path></svg>
            </a>
            <a href="{{ route('menu.index') }}" class="bg-yellow-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between hover:bg-yellow-600 transition">
                <span class="text-lg font-semibold">Kelola Menu</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </a>
            <a href="{{ route('transaction.index') }}" class="bg-red-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between hover:bg-red-600 transition">
                <span class="text-lg font-semibold">Transaksi</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.5 0 2.5 1.5 2.5 3s-1 3-2.5 3-2.5-1.5-2.5-3 1-3 2.5-3zm0-6a10 10 0 110 20 10 10 0 010-20z"></path></svg>
            </a>
        </div>
    </div>
    <div class="text-2xl font-bold mb-6">Dashboard</div>
    <canvas id="weeklySalesChart" width="400" height="200"></canvas>

                        @endsection
                        @section('scripts')
<script>
    const ctx = document.getElementById('weeklySalesChart');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu'],
            datasets: [{
                label: 'Penjualan',
                data: [150, 200, 100],
                backgroundColor: ['#F87171', '#34D399', '#60A5FA'],
            }]
        },
    });
</script>
@endsection