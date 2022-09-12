@extends('layouts.app')

@section('titulo')

    Registrate en Devstagram

@endsection

@section('contenido')    

    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12 p-5">
            <img 
                src="{{ asset('img/registrar.jpg') }}"
                alt="Imagen registro de usuarios"
                class=""
            />
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route("password.reset") }}" method="POST" novalidate>
                @csrf
                
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"                        
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input 
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repite tu password"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>


                <input type="hidden" name="token" value="{{ $token }}">
                <input 
                    type="submit"
                    value="Actualizar contraseña"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-lg text-white"
                />

            </form>
        </div>
    </div>

@endsection