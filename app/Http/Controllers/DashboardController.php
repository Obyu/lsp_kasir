<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = $user->level;
        $transaksis = transaksi::with('pesanan')->get();
        return view('welcome', compact('role','transaksis'));
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


}
