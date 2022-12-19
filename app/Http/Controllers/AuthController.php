<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\LoginRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.masuk');
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'username'  => ['required', 'max:64', 'required_with:password', new LoginRule($request->password, $request->remember)],
            'password'  => ['required']
        ]);
        activity()->log('Login. IP: '. request()->ip() .' ' . request()->userAgent());
        return redirect()->route('dashboard');
    }

    public function keluar()
    {
        activity()->log('Logout');
        Auth::logout();
        return redirect()->route('masuk');
    }
}
