<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\meja;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MejaController extends Controller
{
    public function index ()
    {
        $mejas = meja::all();
        return view('admin.entri-meja.index', compact('mejas'));
    }

    public function create(){
        return view('admin.entri-meja.create');
    }

    public function store(Request $request){
        $request->validate([
            'Nomor_Meja' => 'required|numeric'
        ]);
        if (meja::where('NoMeja', $request->Nomor_Meja)->exists()) {
            return redirect()->back()->with('error', 'Data ini sudah ada');
        }
        try {
            meja::create([
                'NoMeja' => $request->Nomor_Meja,
                'status' => 'kosong'
            ]);
        } catch (ErrorException $e) {
            return Redirect()->back()->with('error', 'Input anda mungkin error : ' .$e->getMessage());
        }
        return Redirect()->route('meja.index');
    }

    public function delete($id)
    {
        $meja = meja::findOrFail($id);
        $meja->delete();

        return Redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}
