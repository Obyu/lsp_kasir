<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Models\menu;
use App\Models\pelanggan;
use App\Models\pesanan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(){
        $pelanggans = pelanggan::whereHas('pesanan')->get();
        return view('waiters.pesanan.index', compact('pelanggans'));
    }
    public function show($id){
        $pesanans = pesanan::where('idpelanggan',$id)->get();
        return view('waiters.pesanan.show' , compact('pesanans'));
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

    public function store(Request $request, $id){
        $request->validate([
            'pelanggan'=>'required',
            'meja' => 'required'

        ]);
        try {
            $meja = meja::find($id);
            $cart = Session::get('cart', []);
            foreach ($cart as $data) {
              pesanan::create([
                    'idmenu'        =>  $data['menu'],
                    'idpelanggan'   =>  $request->pelanggan,
                    'jumlah'        =>  $data['jumlah'],
                    'meja_id'       =>  $request->meja,
                    'iduser'        =>  2
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


    public function edit(){

    }

    public function update()  {

    }

    public function delete($id)
    {
        $meja = pesanan::findOrFail($id);
        $meja->delete();

        return Redirect()->back()->with('success', 'Berhasil Dihapus');

    }
}
