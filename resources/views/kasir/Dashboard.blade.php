@extends('main')
@section('content')

<div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">👋 Selamat Datang, Kasir</h1>
        <p class="text-sm text-gray-500 mt-1">Semoga harimu menyenangkan 🍀</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 border border-gray-300 rounded-full shadow hover:shadow-md transition">
            <div class="text-sm text-gray-500 mb-2">Total Penjualan Hari Ini</div>
            <div class="text-2xl font-bold text-green-600">Rp 2.500.000</div>
        </div>

        <div class="bg-white p-6 border border-gray-300 rounded-full shadow hover:shadow-md transition">
            <div class="text-sm text-gray-500 mb-2">Jumlah Transaksi</div>
            <div class="text-2xl font-bold text-blue-600">{{ $t_transaksi }}</div>
        </div>

        <div class="bg-white p-6 border border-gray-300 rounded-full shadow hover:shadow-md transition">
            <div class="text-sm text-gray-500 mb-2">Shift</div>
            <div class="text-2xl font-bold text-indigo-600">Pagi (08:00 - 16:00)</div>
        </div>
    </div>
    <div class="mt-10 bg-white p-6 border border-gray-300 rounded-2xl shadow">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">📈 Grafik Pendapatan Harian</h2>
    <form action="{{ route('dashboard.kasir') }}" method="get" class="flex gap-4 mb-4">
    <div>
        <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
        <input type="month" name="bulan" id="bulan" value="{{ request('bulan', now()->format('Y-m')) }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div>
        <label for="minggu" class="block text-sm font-medium text-gray-700">Pilih Minggu:</label>
        <select name="minggu" id="minggu"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ request('minggu', ceil(now()->day / 7)) == $i ? 'selected' : '' }}>
                    Minggu {{ $i }}
                </option>
            @endfor
        </select>
    </div>

    <div class="flex items-end">
        <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Filter
        </button>
    </div>
    </form>
    <canvas id="pendapatanChart" height="100"></canvas>
    </div>
                        <script src="/assets/libs/chart.js/Chart.min.js"></script>  
                        <script src="/assets/libs/chart.js/Chart.js"></script>
                        <script src="/assets/libs/chart.js/Chart.bundle.js"></script>
                        <script src="/assets/libs/chart.js/Chart.bundle.min.js"></script>
                        <script>
    const DataPendapatan = @json($p_Harian);
    const ctx = document.getElementById('pendapatanChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($label),
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: DataPendapatan,
                fill: true,
                backgroundColor: 'rgba(99, 102, 241, 0.1)', // soft indigo
                borderColor: 'rgba(99, 102, 241, 1)', // indigo
                tension: 0.4,
                pointBackgroundColor: 'rgba(99, 102, 241, 1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#4B5563'
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#111827',
                    bodyColor: '#374151',
                    borderColor: '#E5E7EB',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    ticks: { color: '#6B7280' },
                    grid: { display: false }
                },
                y: {
                    ticks: { color: '#6B7280' },
                    grid: { color: '#E5E7EB' }
                }
            }
        }
    });
</script>
@endsection