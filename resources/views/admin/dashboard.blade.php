@extends('main')
@section('content')


<div class="max-w-7xl mx-auto space-y-6">

<!-- Top Section -->
<div class="grid grid-cols-3 gap-6">
    <!-- Visits -->
    <div class="bg-white p-6 border border-gray-300 rounded-full shadow hover:shadow-md transition">
    <p class="text-gray-500">Total Menu</p>
        <h1 class="text-4xl font-bold text-gray-800">{{$menu }}</h1>
    </div>

    <!-- Popularity Rate -->
    <div class="bg-white p-6 border border-gray-300 rounded-full shadow hover:shadow-md transition">
        <div>
            <p class="text-gray-500">Total Meja</p>
            <div class="text-4xl font-bold text-gray-500">{{ $meja}}</div>
        </div>
        
    </div>
    <div class="bg-white p-6 border border-gray-300 rounded-full shadow hover:shadow-md transition">
        <div>
            <p class="text-gray-500">Welcome</p>
            <div class="text-4xl font-bold text-gray-500">{{ $role}}</div>
        </div>
        
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
                        
                        
                        
@endsection