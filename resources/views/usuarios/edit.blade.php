@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Usuario</h2>

    <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required
                   class="mt-1 block w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Correo</label>
            <input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}" required
                   class="mt-1 block w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Rol</label>
            <select name="id_rol" required
                    class="mt-1 block w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ $usuario->id_rol == $rol->id_rol ? 'selected' : '' }}>
                        {{ $rol->nombre_rol }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Activo</label>
            <select name="activo_" required
                    class="mt-1 block w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                <option value="1" {{ $usuario->activo_ ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$usuario->activo_ ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('usuarios.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md font-semibold">
                Guardar cambios
            </button>
        </div>
    </form>
</div>
@endsection
