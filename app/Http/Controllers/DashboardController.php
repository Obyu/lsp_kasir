<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Models\menu;
use App\Models\pelanggan;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function chartPendapatan(Request $request)
{
    $bulan = $request->input('bulan', now()->format('Y-m'));
    $minggu = $request->input('minggu', ceil(now()->day / 7));

    $data = DB::select("CALL PendapatanHarian(?, ?)", [$bulan, $minggu]);

    return response()->json($data);
}
    public function index_kasir(Request $request){
        $user = Auth::user();
        $role = $user->level;
        $transaksi = DB::select("CALL total_transaksi()");
        $t_transaksi = $transaksi[0]->t_transaksi;

        $now = now();
        $bulan = $request->input('bulan', now()->format('Y-m'));
        $minggu = $request->input('minggu', ceil(now()->day / 7));
        $income = DB::select("CALL PendapatanHarian(?, ?)", [$bulan,$minggu]);
        $pendapatan = $income[0]->TotalPendapatan ?? 0;
        $transalateHari = [
            'Mondat' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        $p_Harian = [];
        $label = [];

        foreach($income as $row){
            $label[] = $transalateHari[$row->Hari] ?? $row->Hari;
            $p_Harian[] = $row->TotalPendapatan;
        }
        $transaksis = transaksi::with('pesanan')->get();
        return view('kasir.dashboard', compact('pendapatan','label','p_Harian','t_transaksi','role','transaksis'));
    }
    public function index_admin(){
        $user = Auth::user();
        $role = $user->level;

        $tmeja = DB::select("CALL total_meja()");
        $meja = $tmeja[0]->t_meja;

        $tmenu = DB::select("CALL total_menu()");
        $menu = $tmenu[0]->t_menu;



        $transaksis = transaksi::with('pesanan')->get();
        return view('admin.dashboard', compact(
            'menu',
            'meja',
            'role',
            'transaksis'
        ));
    }

    public function index_waiter(){
        $user = Auth::user();
        $role = $user->level;

        $menus = menu::all();
        $pelanggans = pelanggan::all();

        $mejas = DB::select("CALL meja()");

        $tmeja = DB::select("CALL total_meja()");
        $meja = $tmeja[0]->t_meja;

        $tpesanan = DB::select("CALL total_pesanan()");
        $pesanan = $tpesanan[0]->t_pesanan;

        $transaksis = transaksi::with('pesanan')->get();
        return view('waiters.dashboard', compact('pelanggans','menus','mejas','role','pesanan','meja','transaksis'));
    }

    public function index_owner(){
        $user = Auth::user();
        $role = $user->level;

        $data_menu_terlaris = DB::select("CALL menu_terlaris");
        $data_menu_galaku = DB::select("CALL menu_galaku");

        $transaksi = DB::select("CALL total_transaksi()");
        $t_transaksi = $transaksi[0]->t_transaksi;

        $result = DB::select("CALL total_masuk()");
        $total = $result[0]->total_masuk;

        $data = DB::select('CALL income_bulan()');
        $bulan = [];
        $income = [];
        foreach($data as $row){
            $bulan[] = $row->bulan;
            $income[] = $row->total;
        }

        $transaksis = transaksi::with('pesanan')->get();
        return view('owner.dashboard', compact(
            'income',
            'bulan',
            'total',
            'role',
            'transaksis',
            't_transaksi',
            'data_menu_terlaris',
            'data_menu_galaku'
        ));
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');
        $result = pelanggan::where('Namapelanggan', 'LIKE',"%$keyword%")->get();
        return response()->json($result);
    }

}
