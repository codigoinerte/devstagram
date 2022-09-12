<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() // no es necesario request
    {
        // dd('aqui mero');
        return view('perfil.index');
    }

    public function store(Request $request)
    {        
        $request->request->add(['username' => Str::slug($request->username)]);
        
        // dd(auth()->user()->email);
        // dd(!auth()->attempt([ 'password' => $request->password ]));

        // dd($request->only('email','password'));
        // 'in:cliente,proveedor,vendedor' | selecciona especificos de esta lista
        $this->validate($request,[
                'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'], 
                'email'=>['required','unique:users,email,'.auth()->user()->id,'email','max:60'],
                'password'=>['nullable','min:6'],           
                'password_new'=>['nullable','min:6']
        ]);

        if(auth()->attempt([ 'password' => $request->password ]) && $request->password != '' && $request->password_new != ''){
            return back()->with('mensaje','Credenciales incorrectas');
        }

        if($request->imagen){

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid()."." .$imagen->extension();

            $imagenServidor = Image::make($imagen);

            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);            
        }

        //Guardar cambios

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->password = Hash::make($request->password_new) ?? auth()->user()->password ?? null;
        $usuario->email = $request->email ?? auth()->user()->email ?? null;

        $usuario->save();

        //Redireccionar

        return redirect()->route('posts.index', $usuario->username);

    }
}
