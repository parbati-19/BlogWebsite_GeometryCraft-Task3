<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'fullname'=>'required|string|max:255',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:8'
        ]);
        $user = User::create([
            'fullname'=> $request->fullname,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registration successful !');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required' 
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email'=> 'Invalid Credentials',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success',"You're logged out");
    }
}
