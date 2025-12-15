@extends('layouts.app')

@section('title', 'Detalle del Estudiante')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white shadow-xl rounded-2xl p-8">

        <h2 class="flex items-center gap-2 text-2xl font-semibold text-orange-600 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-orange-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.944a11.952 11.952 0 00-6.824-2.887 12.083 12.083 0 01.665-6.479L12 14z" />
            </svg>
            Detalle del Estudiante
        </h2>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- FOTO --}}
            <div class="text-center">
                @if($estudiante->foto)
                <img src="{{ asset('storage/'.$estudiante->foto) }}"
                    class="mx-auto rounded-xl shadow w-40 h-40 object-cover">
                @else
                <div class="w-40 h-40 mx-auto bg-gray-200 rounded-xl flex items-center justify-center">
                    Sin foto
                </div>
                @endif
            </div>

            {{-- DATOS --}}
            <div class="md:col-span-2 space-y-2 text-gray-700">
                <p><strong>DNI:</strong> {{ $estudiante->dni }}</p>
                <p><strong>Nombres:</strong> {{ $estudiante->nombres }}</p>
                <p><strong>Apellidos:</strong> {{ $estudiante->apellidos }}</p>
                <p><strong>Edad:</strong> {{ $estudiante->edad }}</p>
                <p><strong>Género:</strong> {{ $estudiante->genero }}</p>
                <p><strong>Grado:</strong> {{ $estudiante->grado }}</p>
                <p><strong>Sección:</strong> {{ $estudiante->seccion }}</p>

                {{-- ESTADO --}}
                <p>
                    <strong>Estado:</strong>
                    @if($estudiante->estado === 'Activo')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                        Activo
                    </span>
                    @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                        Retirado
                    </span>
                    @endif
                </p>

                <p><strong>Dirección:</strong> {{ $estudiante->direccion }}</p>
                <p><strong>Teléfono:</strong> {{ $estudiante->telefono }}</p>
            </div>
        </div>

        {{-- QR --}}
        <div class="mt-8 text-center">
            <h3 class="font-semibold mb-2">Código QR</h3>
            <img src="{{ asset('storage/'.$estudiante->codigo_qr) }}" class="mx-auto w-32">
        </div>

        {{-- BOTONES --}}
        <div class="mt-8 flex justify-between">
            <a href="{{ route('estudiantes.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Volver
            </a>

            <div class="space-x-2">
                <a href="{{ route('estudiantes.edit', $estudiante->Id_estudiante) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Editar
                </a>

                <a href="{{ route('estudiantes.pdf', $estudiante->Id_estudiante) }}"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    PDF
                </a>
                {{-- 🔐 SOLO DIRECTOR --}}
                @if(session()->has('usuario_id') && session('id_rol') == 3)
                <a href="{{ route('asistencias.resumen', $estudiante->Id_estudiante) }}"
                    class="inline-block mt-4 px-5 py-2 bg-indigo-600 text-white
          rounded hover:bg-indigo-700 transition">
                    📊 Ver Resumen de Asistencia
                </a>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection