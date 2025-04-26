@extends('main')
@section('content')


<div class="max-w-7xl mx-auto space-y-6">

<!-- Top Section -->
<div class="grid grid-cols-3 gap-6">
    <!-- Visits -->
    <div class="bg-gradient-to-br from-blue-50 via-white to-purple-50 p-6 rounded-2xl shadow">
    <p class="text-gray-500">Total Pendapatan</p>
        <h1 class="text-4xl font-bold text-gray-800">{{'Rp.' . number_format($total,0,'.',',')  }}</h1>
        <div class="mt-4 text-sm text-gray-600 space-y-1">
           
        </div>
        <button class="mt-6 bg-cyan-600 text-white px-4 py-2 rounded-full text-sm hover:bg-cyan-700">
            VIEW FULL STATISTIC
        </button>
    </div>

    <!-- Popularity Rate -->
    <div class="bg-white rounded-2xl p-6 shadow flex flex-col justify-between">
        <div>
            <p class="text-gray-500">Total Transaksi</p>
            <div class="text-5xl font-bold text-orange-500">{{ $t_transaksi }}</div>
        </div>
        
    </div>

    <!-- Illustration -->

</div>

<!-- Middle Section -->
<div class="grid grid-cols-3 gap-6">
    <!-- Finance Performance -->
    <div class="bg-white rounded-2xl p-6 shadow">
        <div class="text-sm text-gray-500 mb-2">Monthly Income</div>
        <h2 class="text-3xl font-bold text-gray-800">{{'Rp.' . number_format($total,0,'.',',')  }}</h2>
        <canvas id="financeChart" class="mt-6"></canvas>
    </div>

    <!-- Top Performers -->
    <div class="bg-white rounded-2xl p-6 shadow">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Top 5 Menu Terlaris</h3>
        <ul class="space-y-4">
            @foreach ($data_menu_terlaris as $item)
            <li class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <label for="">{{ $loop->iteration }}</label>
                    <div>
                        <p class="font-medium">{{ $item->Namamenu }}</p>
                        <span class="text-xs text-green-500">{{ 'Rp.' . number_format($item->Harga,0,'.',',') }}</span>
                    </div>
                </div>
                <span class="text-sm text-gray-500">{{ $item->terjual }}</span>
            </li>    
            @endforeach
        </ul>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Top 5 Menu Tidak Laku</h3>
        <ul class="space-y-4">
            @foreach ($data_menu_galaku as $item)
            <li class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <label for="">{{ $loop->iteration }}</label>
                    <div>
                        <p class="font-medium">{{ $item->Namamenu }}</p>
                        <span class="text-xs text-green-500">{{ 'Rp.' . number_format($item->Harga,0,'.',',') }}</span>
                    </div>
                </div>
                <span class="text-sm text-gray-500">{{ $item->terjual }}</span>
            </li>    
            @endforeach
        </ul>
    </div>

    <!-- Targeting by Region -->

</div>
</div>


  

                        <script src="/assets/libs/chart.js/Chart.min.js"></script>
                        <script src="/assets/libs/chart.js/Chart.js"></script>
                        <script src="/assets/libs/chart.js/Chart.bundle.js"></script>
                        <script src="/assets/libs/chart.js/Chart.bundle.min.js"></script>
                        
                        
                        <script>
                            const ctx = document.getElementById('financeChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: @json($bulan),
                                    datasets: [{
                                        label: 'Income',
                                        data: @json($income),
                                        backgroundColor: '#0ea5e9',
                                        borderRadius: 10
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                           </script>
@endsection