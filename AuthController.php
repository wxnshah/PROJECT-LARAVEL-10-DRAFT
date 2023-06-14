<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidation;

class AuthController extends Controller
{
  public function proses_daftar(RegisterValidation $request){
        $pass_encrypt = bcrypt($request->input('password'));
        $data = [
            'nama_pengguna' => $request->input('nama_pengguna'),
            'email' => $request->input('email'),
            'password' => $pass_encrypt,
            'created_at' => now(),
        ];

        // Simpan ke DB
        // return dd($data);
        DB::table('users')->insert($data);

        // Response
        return redirect()->route('login')
        ->with('success-insert', 'Rekod berjaya disimpan!');

        // return view('dashboard.epantau.senarai_aduan');
    }
  
    public function check_login(LoginValidation $request){
        $credential = $request->only('email', 'password');

        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        // return dd($credential);
        return back()->withInput()->with('failed-login', 'Email atau Kata Laluan Salah !');
    }
  
    public function logout(Request $request): RedirectResponse{
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
