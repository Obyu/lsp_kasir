<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Models\menu;
use App\Models\pelanggan;
use App\Models\pesanan;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $pesanans = pesanan::with('menu','pelanggan','meja')->get();
        return view('waiters.pesanan.index', compact('pesanans'));
    }

    public function create(){
        $menus = menu::all();
        $pelanggans = pelanggan::all();
        $mejas = meja::where('status', 'kosong')->get();
        return view('waiters.pesanan.create', compact('menus','pelanggans','mejas'));
    }

    public function store(Request $request, $id){
        $request->validate([
            'menu'=>'required',
            'pelanggan'=>'required',
            'jumlah'  => 'required',
            'meja' => 'required'

        ]);
        try {
            $KodePesanan = pesanan::Kodepesanan();
            $meja = meja::find($id);
            pesanan::create([
                'idmenu'        =>  $request->menu,
                'kode_pesanan'  =>  $KodePesanan,
                'idpelanggan'   =>  $request->pelanggan,
                'jumlah'        =>  $request->jumlah,
                'meja_id'       =>  $request->meja,
                'iduser'        =>  2
            ]);
            $meja->status = 'terpakai';
            $meja->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error','anda salah memasukan data' . $e->getMessage());
        }
        return redirect()->route('pesanan.index')->with('success','anda berhasil membuat pesanan');
    }


    public function edit(){

    }

    public function update()  {

    }

    public function delete(){

    }
}
