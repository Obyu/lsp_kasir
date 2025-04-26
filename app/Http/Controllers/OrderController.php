<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Models\menu;
use App\Models\pelanggan;
use App\Models\pesanan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(){
        $pelanggans = pelanggan::whereHas('pesanan')->get();
        return view('waiters.pesanan.index', compact('pelanggans'));
    }
    public function show($id){
        $pelanggan = pelanggan::findOrFail($id);
        $meja = $pelanggan->pesanan()->first()?->meja?->id;
        $pesanans = pesanan::where('idpelanggan',$id)->get();
        return view('waiters.pesanan.show' , compact('pesanans','pelanggan','meja'));
    }

    public function AddToCart(Request $request)
    {
        $cart = Session::get('cart', []);
        $cart[] = [
            'menu' => $request->menu,
            'jumlah' => $request->jumlah
        ];
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Item ditambahkan ke pesanan!');
    }
    public function create(){
        $menus = menu::all();
        $pelanggans = pelanggan::all();
        $cart = Session::get('cart', []);
        $mejas = meja::where('status', 'kosong')->get();
        return view('waiters.pesanan.create',compact('cart','menus','pelanggans','mejas',));
    }
    public function Newcreate($id, $idmeja){
        $menus = menu::all();
        $pelanggans = pelanggan::find($id);
        $cart = Session::get('cart', []);
        $mejas = meja::find($idmeja);
        return view('waiters.pesanan.new-order',compact('cart','menus','pelanggans','mejas',));
    }

    public function store(Request $request){
        $request->validate([
            'pelanggan'=>'required',
            'meja' => 'required'

        ]);
        $user = Auth::user();
        try {
            $meja = meja::find($request->meja);
            $cart = Session::get('cart', []);
            foreach ($cart as $data) {
              pesanan::create([
                    'idmenu'        =>  $data['menu'],
                    'idpelanggan'   =>  $request->pelanggan,
                    'jumlah'        =>  $data['jumlah'],
                    'meja_id'       =>  $meja->id,
                    'iduser'        =>  $user->iduser
              ]);
        }
            $meja->status = 'terpakai';
            $meja->save();
            session()->forget(['cart']);
        } catch (Exception $e) {
            return redirect()->back()->with('error','anda salah memasukan data' . $e->getMessage());
        }
        return redirect()->route('pesanan.index')->with('success','anda berhasil membuat pesanan');
    }


    public function edit($id){
        $pesanan = pesanan::findOrFail($id);
        $menus = menu::all();
        
        return view('waiters.pesanan.edit', compact('pesanan','menus'));
    }

    public function update(Request $request , $id, $idpelanggan)  {
        $pesanan = pesanan::findOrFail($id);
        $pesanan->update([
            'idmenu' => $request->menu,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('pesanan.show',$idpelanggan)->with('success', 'berhasil mengedit data');
    }

    public function delete($id)
    {
        $meja = pesanan::findOrFail($id);
        $meja->delete();

        return Redirect()->back()->with('success', 'Berhasil Dihapus');

    }
}
