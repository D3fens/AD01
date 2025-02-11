<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User diimport

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login_proses(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data =[
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('successs', 'Login berhasil!');
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil Logout');
    }


    public function register(){
        return view('auth.register');
    }

    public function register_proses(Request $request){

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // // Debugging: cek apakah data sudah benar
        // dump($data);
        User::create($data);

        $login =[
            'email' => $request->email,
            'password' => $request->password,
        ];
        return redirect()->route('login')->with('sukses', 'Registrasi berhasil! Silakan login.');
        if (Auth::attempt($login)) {
            return redirect()->intended('login')->with('successs', 'Login berhasil!');
        } else {
            return redirect()->route('register')->with('failed', 'Email atau Password Salah');
        }

    }
}

