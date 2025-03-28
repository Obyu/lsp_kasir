<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pelanggan;
use Exception;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggans = pelanggan::all();
        return view('admin.pelanggan.index',compact('pelanggans'));
    }

    public function create(){
        return view('admin.pelanggan.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string',
            'jk' => 'required|in:laki-laki,perempuan',
            'hp' => 'required|numeric',
            'alamat' => 'required'
        ]);

        try {
            pelanggan::create([
                'Namapelanggan' => $request->nama,
                'Jeniskelamin' => $request->jk,
                'Nohp' => $request->hp,
                'alamat' => $request->alamat
            ]);
        } catch (Exception $th) {
           return redirect()->back()->with('error', 'data yang anda masukan salah' . $th->getMessage());
        }

        return redirect()->route('pelanggan.index')->with('success','anda berhasil menambah data pelanggan');

    }

    public function edit($id){
        
    }

    public function update(Request $request, $id)  {
        $pelanggan = pelanggan::findOrFail($id);
        $pelanggan->update([
            'Namapelanggan' => $request->nama,
            'Jeniskelamin' => $request->jk,
            'Nohp' => $request->hp,
            'alamat' => $request->alamat
        ]);
        $pelanggan->save();
        return redirect()->back()->with('success', 'anda berhasil mengedit data');
    }

    public function delete($id){
        $pelanggan = pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus data');
    }
}
