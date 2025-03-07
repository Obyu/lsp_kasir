<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\meja;
use App\Models\pesanan;
use App\Models\transaksi;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $pesanans = pesanan::with('pelanggan')->get();
        return view('admin.transaksi.index',compact('pesanans'));
    }

    public function create($id){
        $pesanans = pesanan::with('menu')->findOrFail($id);
        $transaction = transaksi::with('pesanan.menu')->get();
        return view('admin.transaksi.create', compact('transaction','pesanans'));
    }

    public function store(Request $request, $id){
        
        $meja = meja::find($id);
        $request->validate([
        'idpesanan' =>  'required',	
        'total'     =>  'required|numeric',	
        'bayar'     =>  'required|numeric',	
        ]);

        try {
            $total = $request->total;
            $bayar = $request->bayar;
            $kembalian = 0;
            $kurang = 0;
            if ($bayar > $total) {
                $kembalian = $bayar - $total;
            } elseif ($bayar < $total) {
                $kurang = $total - $bayar;
            }
            transaksi::create([
                'idpesanan' =>  $request->idpesanan,	
                'total'     =>  $total,	
                'bayar'     =>  $bayar,	
                'kembalian' =>  $kembalian,
                'Kurang'    =>  $kurang,
            ]);
            $meja->status = 'kosong';
            $meja->save();
        } catch (Exception $th) {
           return redirect()->back()->with('error', 'data yang anda masukan salah' . $th->getMessage());
        }

        return redirect()->route('transaction.report')->with('success','anda berhasil menambah data transaksi');

    }
    
    public function Show(){
        $transaksis = transaksi::with('pesanan')->get();
        return view('report', compact('transaksis'));
    }

    public function edit(){

    }

    public function update()  {

    }

    public function delete(){

    }
}
