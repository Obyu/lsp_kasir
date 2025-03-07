<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'nama'=>'required',
            'password'=>'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->level) {
                case 'admin':
                    return redirect()->route('dashboard.dashboard')->with('success'.'Anda Berhasil Login' . $user->level);
                case 'waiter':
                    return redirect()->route('dashboard.waiter')->with('success'.'Anda Berhasil Login' . $user->level);
                case 'kasir':
                    return redirect()->route('dashboard.kasir')->with('success'.'Anda Berhasil Login' . $user->level);
                case 'owner':
                    return redirect()->route('dashboard.owner')->with('success'.'Anda Berhasil Login' . $user->level);
                    default:
                    return redirect()->route('login.index')->with('error', 'Level pengguna tidak dikenali.');
            }
        } else {
           
            return redirect()->route('login.index')->with('error', 'Login gagal. Periksa nama atau password Anda.');
        }    
            
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

}
