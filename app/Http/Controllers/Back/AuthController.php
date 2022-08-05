<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }

    public function loginPost(Request $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            toastr()->success( 'Tekrardan hoşgeldiniz, ' . auth()->user()->name, 'Başarılı!',);
            return redirect()->route('admin.dashboard');

        }else{
            return back()->withInput($req->all())->with('msg', 'Email adresi veya şifre hatalı!');

        }
        
    }
    
    public function logout()
    {
        auth()->logout();
        toastr()->info( 'Çıkış işlemi başarılı!.');
        return redirect()->route('admin.login');
    }

}
