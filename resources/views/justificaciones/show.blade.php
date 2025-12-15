@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-100 mt-8">

    <div class="mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Ver Justificación</h2>
        <p class="text-sm text-gray-500">Solo lectura, no se puede modificar.</p>
    </div>

    <div class="mb-4">
        <label class="block mb-1 text-sm font-bold text-gray-700">Motivo</label>
        <p class="text-gray-800">{{ $justificacion->motivo }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-1 text-sm font-bold text-gray-700">Observación</label>
        <p class="text-gray-800">{{ $justificacion->observacion_auxiliar ?? 'Sin observación' }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-1 text-sm font-bold text-gray-700">Archivo adjunto</label>
        @if($justificacion->rutaArchivo)
            <a href="{{ asset('storage/' . $justificacion->rutaArchivo) }}" target="_blank"
               class="text-blue-600 hover:text-blue-800 underline text-sm">
               Ver documento
            </a>
        @else
            <span class="text-gray-400 text-sm italic">No hay archivo adjunto</span>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('asistencias.index') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
           Volver
        </a>
    </div>

</div>
@endsection
