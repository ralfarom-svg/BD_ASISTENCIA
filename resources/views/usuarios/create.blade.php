@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Crear nuevo usuario
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Nombre</label>
            <input type="text" name="nombre" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-300">
        </div>

        <div>
            <label class="block font-medium">Correo</label>
            <input type="email" name="correo" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-300">
        </div>

        <div>
            <label class="block font-medium">Contraseña</label>
            <input type="password" name="password" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-300">
        </div>

        <div>
            <label class="block font-medium">Rol</label>
            <select name="id_rol" required
                class="w-full border rounded px-3 py-2">
                <option value="">Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}">
                        {{ $rol->nombre_rol }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ url('/') }}"
               class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                Cancelar
            </a>

            <button type="submit"
                class="px-6 py-2 rounded bg-orange-600 text-white
                       hover:bg-orange-700">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
