<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function proseslogin(Request $request)
    {
        if (Auth::guard('mitra')->attempt(['sobat_id' => $request->sobat_id, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Sobat ID atau Password salah']);
        }
    }

    public function proseslogout()
    {
        if (Auth::guard('mitra')->check()) {
            Auth::guard('mitra')->logout();
            return redirect('/');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning' => 'Email atau Password salah']);
        }
    }

    public function proseslogoutadmin()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }
}
