@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <div class="mt-10 md:mt-0">

                <form   action="{{ route("perfil.store") }}" 
                        method="POST" 
                        enctype="multipart/form-data"
                        novalidate>
                    @csrf

                    @if(session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ session('mensaje') }}</p>
                    @endif

                    <div class="mb-5">
                        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                            Username
                        </label>
                        <input 
                            id="username"
                            name="username"
                            type="text"
                            placeholder="Tu nombre"
                            class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                            value="{{ auth()->user()->username }}"
                        />
    
                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                            Imagen perfil
                        </label>
                        <input 
                            id="imagen"
                            name="imagen"
                            type="file"
                            class="border p-3 w-full rounded-lg"                           
                            accept=".jpg,.jpeg,.png"
                        />
                       
                    </div>

                    <div class="mb-5">
                        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                            Email
                        </label>
                        <input 
                            id="email"
                            name="email"
                            type="email"
                            placeholder="Tu nuevo email"
                            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                            value="{{ auth()->user()->email }}"
                        />
                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password antiguo
                        </label>
                        <input 
                            id="password"
                            name="password"
                            type="password"
                            placeholder="password antiguo"
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" 
                            autocomplete="new-password"
                        />
                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password_new" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password antiguo
                        </label>
                        <input 
                            id="password_new"
                            name="password_new"
                            type="password"
                            placeholder="password nuevo"
                            class="border p-3 w-full rounded-lg @error('password_new') border-red-500 @enderror"                        
                        />
                        @error('password_new')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    
                                            
                    <input 
                        type="submit"
                        value="Guardar cambios"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-lg text-white"
                    />
    
                </form>

            </div>
        </div>
    </div>

@endsection