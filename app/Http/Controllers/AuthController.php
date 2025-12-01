<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ⬛ halaman login
    public function loginPage() {
        return view('auth.login');
    }

    // ⬛ proses login
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('dashboard')->with('success','Berhasil Login');
        }

        return back()->withErrors(['email'=>'Email atau password salah']);
    }

    // ⬛ halaman register
    public function registerPage() {
        return view('auth.register');
    }

    // ⬛ proses register
    public function register(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('login.page')->with('success','Registrasi berhasil, silahkan login');
    }

    // ⬛ Logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login.page');
    }
}
