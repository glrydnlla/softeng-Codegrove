<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function view() {
        return view('register');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'alpha_dash', 'unique:users', 'regex:/^[a-zA-Z0-9_.]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'dob' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request->username);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'display_picture_path' => 'gg--profile.png',
            'role' => 'user'
        ]);
        
        $userId = $user->id;
    
        return redirect()->route('select-language-view', ['userId' => $userId]);

    }
}
