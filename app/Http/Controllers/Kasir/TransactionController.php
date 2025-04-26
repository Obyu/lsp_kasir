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
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index(){
        $pelanggans = pelanggan::whereHas('pesanan')->get();
        $pesanans = pesanan::with('pelanggan')->get();
        return view('admin.transaksi.index',compact('pesanans','pelanggans'));
    }

    public function create($id){
        $pelanggan = pelanggan::findOrFail($id);
        $meja = pesanan::where('idpelanggan',$id)->first();
        $idmeja = $meja->meja->id;
        $transaksi = DB::table('pesanan')
        ->join('menu', 'pesanan.idmenu', '=', 'menu.idmenu')
        ->where('pesanan.idpelanggan', $id)
        ->selectRaw('SUM(menu.harga * pesanan.jumlah) AS total_harga')
        ->groupBy('pesanan.idpelanggan')
        ->first();
        return view('admin.transaksi.create', compact('meja','idmeja','transaksi','pelanggan'));
    }

    public function store(Request $request, $id){
        $meja = meja::findOrFail($id);
        $request->validate([
            'idpelanggan' => 'required',
            'total'       => 'required|numeric|min:1',	
            'bayar'       => 'required|numeric|min:0',
        ]);
        $idpesanan = $request->idpesanan;
    
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
            $meja->status = 'kosong';
            $meja->save();
            pesanan::find($idpesanan)->delete();
    
            return redirect()->route('transaction.report')->with('success', 'Transaksi berhasil ditambahkan!');
    
        } catch (Exception $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }
    
    
    public function Show(Request $request)
    {
        $query = Transaksi::query();
    
        $filter = $request->input('filter', 'all');
        $year = $request->input('year');
        $bulan = $request->input('bulan');
    
        $tanggalFilter = ''; // untuk label filter di laporan
    
        if ($filter == 'today') {
            $query->whereDate('created_at', Carbon::today());
            $tanggalFilter = Carbon::today()->format('d F Y'); // contoh: 27 April 2025
        } elseif ($filter == 'this_month' && $bulan) {
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $bulan);
        } elseif ($filter == 'year' && $year) {
            $query->whereYear('created_at', $year);
        } 
        $tanggalFilter = Carbon::createFromDate($year, $bulan, 1)->translatedFormat('F Y');

    
        $transaksis = $query->with('pelanggan')->orderBy('created_at', 'desc')->get();
        $total = $transaksis->sum('total');
        $tanggalCetak = now()->format('d F Y'); // tanggal saat dicetak
    
        // Kalau mau print
        if ($request->input('print') == 'true') {
            return view('generate', compact('transaksis', 'total', 'tanggalFilter', 'tanggalCetak'));
        }
    
        return view('report', compact('transaksis'));
    }
    

    public function Stransaksi(Request $request){
        $Idpelanggan = $request->input('idpelanggan');
        $transaksi = pelanggan::where('idpelanggan', $Idpelanggan)->whereHas('pesanan')->get();
        return response()->json($transaksi);
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
