<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\menu;
use Exception;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = menu::all();
        return view('admin.menu.index', compact('menus'));
    }
    public function create(){
        return view('admin.menu.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'Nama_Menu' => 'required|string',
            'Harga' => 'required|numeric'
        ]);
        try {
            menu::create([
                'Namamenu' => $request->Nama_Menu,
                'Harga' => $request->Harga
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'ada kesalahan data:'.$e->getMessage());
        }
        return redirect()->route('menu.index')->with('success','anda berhasil menambahkan data');
    }
    public function edit($id)
    {
        $menu = menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }
    public function update(Request $request, $id)
    {
        $menu = menu::findOrFail($id);
        $menu->update([
            'Namamenu' => $request->Nama_Menu,
            'Harga' => $request->Harga
        ]);

        return redirect()->route('menu.index')->with('success', 'Anda berhasil  merubah Data');
    }

    public function delete($id)
    {
       $menu = menu::findOrfail($id);
       $menu->delete();
       return redirect()->back()->with('success','Anda berhasil menghapus');
    }
}
