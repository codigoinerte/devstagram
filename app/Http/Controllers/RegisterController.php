<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {        
        // dd($request->get('name')); obtener el parametro


        //Modificar el request

        $request->request->add(['username' => Str::slug($request->username)]);

        // Validacion
        $this->validate($request,[
            'name' => ['required','max:30'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email'=>['required','unique:users','email','max:60'],
            'password'=>['required','confirmed','min:6']
        ]);

        // dd('Creando usuario');
        User::create([
            'name'=> $request->name, //$request->get('name')
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Authenticar  el usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        /** Otra forma de authenticar */

        auth()->attempt($request->only('email', 'password'));

        // Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}