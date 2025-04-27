@extends('main')
@section('content')


<div class="max-w-7xl mx-auto space-y-6">

<!-- Top Section -->
<div class="grid grid-cols-3 gap-6">
    <!-- Visits -->
    <div class="bg-white border border-gray-500 p-6 rounded-2xl shadow">
    <p class="text-gray-500">Total Pendapatan</p>
        <h1 class="text-4xl font-bold text-gray-800">{{'Rp.' . number_format($total,0,'.',',')  }}</h1>
        <div class="mt-4 text-sm text-gray-600 space-y-1">
           
        </div>
        <button class="mt-6 bg-cyan-600 text-white px-4 py-2 rounded-full text-sm hover:bg-cyan-700">
            VIEW FULL STATISTIC
        </button>
    </div>

    <!-- Popularity Rate -->
    <div class="bg-white border border-gray-500 rounded-2xl p-6 shadow flex flex-col justify-between">
        <div>
            <p class="text-gray-500">Total Transaksi</p>
            <div class="text-5xl font-bold text-orange-500">{{ $t_transaksi }}</div>
        </div>
        
    </div>
       <div class="bg-white border border-gray-500 rounded-2xl p-6 shadow">
        <div class="text-sm text-gray-500 mb-2">Monthly Income</div>
        <h2 class="text-3xl font-bold text-gray-800">{{'Rp.' . number_format($total,0,'.',',')  }}</h2>
        <canvas id="financeChart" class="mt-6"></canvas>
    </div>

    <!-- Illustration -->

</div>

<!-- Middle Section -->
<div class="grid grid-cols-3 gap-6">
    <!-- Finance Performance -->
 

    <!-- Top Performers -->
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