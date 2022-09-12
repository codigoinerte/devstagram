<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        // dd('Authenticando...');
        // dd($request->remember);

        $this->validate($request,[

            'email'=>['required','email'],
            'password'=>['required']

        ]);


        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje','Credenciales incorrectas');
        }

        // $usuario = User::find(5);

        // auth()->attempt([
        //     'email' => $usuario->email,
        //     'password' => $usuario->password,
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
        // return redirect()->route('posts.index', 'webmaster');

    }
}
