<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view() {
        return view('login');
    }

    public function login(Request $request)
    {
        $creds = $request->creds;
        $password = $request->password;
        // dd($password);

        if (Auth::attempt(['email' => $creds, 'password' => $password])) {
            if (Auth::user()->role == "admin") {
                return redirect('/admin');
            }
            return redirect('/');
        }

        if (Auth::attempt(['username' => $creds, 'password' => $password])) {
            if (Auth::user()->role == "admin") {
                return redirect('/admin');
            }
            return redirect('/');
        }

        return redirect()->back()->withInput()->withErrors(['creds' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
}
