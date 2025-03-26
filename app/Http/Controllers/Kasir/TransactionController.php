<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\meja;
use App\Models\pelanggan;
use App\Models\pesanan;
use App\Models\transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $pelanggans = pelanggan::whereHas('pesanan')->get();
        $pesanans = pesanan::with('pelanggan')->get();
        return view('admin.transaksi.index',compact('pesanans','pelanggans'));
    }

    public function create($id){
        $pelanggan = pelanggan::findOrFail($id);
        $transaksi = DB::table('pesanan')
        ->join('menu', 'pesanan.idmenu', '=', 'menu.idmenu')
        ->where('pesanan.idpelanggan', $id)
        ->selectRaw('SUM(menu.harga * pesanan.jumlah) AS total_harga')
        ->groupBy('pesanan.idpelanggan')
        ->first();
        return view('admin.transaksi.create', compact('transaksi','pelanggan'));
    }

    public function store(Request $request){

        $request->validate([
            'idpelanggan' => 'required',
            'total'       => 'required|numeric|min:1',	
            'bayar'       => 'required|numeric|min:0',
        ]);
    
        try {
            $total = $request->total;
            $bayar = $request->bayar;
            $kembalian = $bayar > $total ? $bayar - $total : 0;
            $kurang = $bayar < $total ? $total - $bayar : 0;
    
            transaksi::create([
                'total'       => $total,
                'bayar'       => $bayar,
                'idpelanggan' => $request->idpelanggan,
                'kembalian'   => $kembalian,
                'Kurang'      => $kurang,
            ]);
    
            return redirect()->route('transaction.report')->with('success', 'Transaksi berhasil ditambahkan!');
    
        } catch (Exception $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }
    
    
    public function Show(Request $request){
        $query = Transaksi::query();

        $filter = $request->input('filter', 'all');
        $year = $request->input('year');
    
        if ($filter == 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter == 'this_month') {
            $query->whereYear('created_at', Carbon::now()->year)
                  ->whereMonth('created_at', Carbon::now()->month);
        } elseif ($filter == 'last_month') {
            $query->whereYear('created_at', Carbon::now()->subMonth()->year)
                  ->whereMonth('created_at', Carbon::now()->subMonth()->month);
        } elseif ($filter == 'year' && $year) {
            $query->whereYear('created_at', $year);
        }
    
        $transaksis = $query->with('pelanggan')->get();
    
        return view('report', compact('transaksis'));
    }

    public function print($id)
    {
        $transaksi = transaksi::where('idpelanggan', $id)->first();
        if ($transaksi->Kurang > 0) {
            return redirect()->back()->with('error', 'Harap Lunasi Pembayaran anda');
        }
        $pesanans = pesanan::where('idpelanggan',$id)->get();
        $pesanan = pesanan::where('idpelanggan',$id)->first();
        $pdf = Pdf::loadView('invoices.template2', compact('pesanans','pesanan','transaksi'));
        return $pdf->stream('infoice.pdf');
    }

    public function edit(){

    }

    public function update()  {

    }

    public function delete(){

    }
}
