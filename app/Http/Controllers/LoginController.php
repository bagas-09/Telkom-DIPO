<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:account')->except('logout');
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // dd([$request->email, $request->password]);
        if (Auth::guard('account')->attempt(['email' => $request->email, "password" => $request->password])) {
            return redirect()->intended(route('admin.dashboard.index'));
        }
        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        Auth::guard('account')->logout();
        return redirect('/login');
    }
}
