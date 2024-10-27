<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email',$request->email)->first();
        if ($user && Hash::check($request->password , $user -> password)) {
            $token = $user->createToken($request->email);
            return $token;
        }

        return [
            'email' => 'The provided credentials do not match our records.',
        ];
    }
}
