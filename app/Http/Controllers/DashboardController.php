<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = $user->level;
        $totalPenjualan = transaksi::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->sum('total');
        $totalPenjualanbulanlalu = transaksi::whereMonth('created_at', Carbon::now()->subMonth()->month)
                                    ->whereYear('created_at', Carbon::now()->subMonth()->year)
                                    ->sum('total');
        $persentase = $totalPenjualanbulanlalu > 0 
                    ? (($totalPenjualan - $totalPenjualanbulanlalu) / $totalPenjualanbulanlalu) * 100 : 0;

        return view('welcome', compact('totalPenjualan','totalPenjualanbulanlalu','persentase','role',));
    }
    public function index_kasir(){
        $user = Auth::user();
        $role = $user->level;
        $transaksis = transaksi::with('pesanan')->get();
        return view('kasir.dashboard', compact('role','transaksis'));
    }

    public function index_waiter(){
        $user = Auth::user();
        $role = $user->level;
        $transaksis = transaksi::with('pesanan')->get();
        return view('waiters.dashboard', compact('role','transaksis'));
    }

    public function index_owner(){
        $user = Auth::user();
        $role = $user->level;
        $transaksis = transaksi::with('pesanan')->get();
        return view('owner.dashboard', compact('role','transaksis'));
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');
        $result = pelanggan::where('Namapelanggan', 'LIKE',"%$keyword%")->get();
        return response()->json($result);
    }

}
