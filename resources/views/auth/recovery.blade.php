@extends('layouts.app')

@section('titulo')

    Recuperar contraseña

@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12 p-5">
            <img 
                src="{{ asset('img/login.jpg') }}"
                alt="Imagen login de usuarios"
                class=""
            />
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('recovery.store') }}" novalidate>
                @csrf
                
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ session('mensaje') }}</p>
                @endif

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
                                
                                                
                <input 
                    type="submit"
                    value="Recuperar contraseña"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-lg text-white"
                />

            </form>
        </div>
    </div>

@endsection