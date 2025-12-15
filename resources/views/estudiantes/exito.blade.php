@extends('layouts.app')

@section('content')
<div class="bg-gray-100 p-10 min-h-screen flex justify-center">
    <div class="bg-white shadow-xl rounded-lg p-8 max-w-xl w-full text-center">

        <h2 class="text-2xl font-bold text-orange-700 mb-4">
            ¡Usuario creado exitosamente! 🎉
        </h2>

        {{-- FOTO DEL ESTUDIANTE --}}
        <div class="flex justify-center mb-4">
            <img src="{{ $estudiante->foto ? asset('storage/' . $estudiante->foto) : asset('images/profile_default.png') }}"
                 alt="Foto del estudiante"
                 class="w-28 h-28 rounded-full shadow-md object-cover border">
        </div>

        {{-- DATOS PERSONALES --}}
        <div class="text-left text-gray-700 mb-4 space-y-1">

            <p><strong>Nombre completo:</strong> {{ $estudiante->nombres }} {{ $estudiante->apellidos }}</p>

            <p><strong>DNI:</strong> {{ $estudiante->dni }}</p>

            <p><strong>Edad:</strong> {{ $estudiante->edad }}</p>

            <p><strong>Teléfono:</strong> {{ $estudiante->telefono }}</p>

            <p><strong>Grado y sección:</strong> {{ ucfirst($estudiante->grado) }} - {{ strtoupper($estudiante->seccion) }}</p>

        </div>

        {{-- QR --}}
        <div class="my-6">
            <img src="{{ asset('storage/' . $estudiante->codigo_qr) }}"
                 alt="QR del estudiante"
                 class="mx-auto w-44 h-44 object-contain">
        </div>

        {{-- BOTÓN PDF --}}
        <a href="{{ route('estudiantes.pdf', $estudiante->Id_estudiante) }}"
           class="px-6 py-3 bg-red-600 rounded-lg text-white font-semibold hover:bg-red-700 transition">
            Exportar PDF
        </a>

    </div>
</div>
@endsection
