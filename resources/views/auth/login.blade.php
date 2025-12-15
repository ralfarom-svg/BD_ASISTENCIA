@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <h2 class="text-2xl font-bold text-center text-orange-600 mb-6">
            Iniciar Sesión
        </h2>

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            {{-- CORREO --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Correo electrónico
                </label>
                <input type="email"
                       name="correo"
                       value="{{ old('correo') }}"
                       required
                       class="w-full h-11 px-4 rounded-lg border border-gray-300
                              focus:border-orange-500 focus:ring focus:ring-orange-200">
                @error('correo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Contraseña
                </label>
                <input type="password"
                       name="password"
                       required
                       class="w-full h-11 px-4 rounded-lg border border-gray-300
                              focus:border-orange-500 focus:ring focus:ring-orange-200">
            </div>

            {{-- BOTÓN --}}
            <button type="submit"
                    class="w-full bg-orange-600 text-white py-3 rounded-lg
                           font-semibold hover:bg-orange-700 transition shadow cursor-pointer">
                Ingresar
            </button>

        </form>

    </div>
</div>
@endsection
