@extends('layouts.app')

@section('title', 'Resumen de Asistencia')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">

    {{-- ENCABEZADO --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            📊 Resumen de Asistencia
        </h2>

        <p class="text-gray-600 mt-1">
            Estudiante:
            <span class="font-semibold">
                {{ $estudiante->apellidos }}, {{ $estudiante->nombres }}
            </span>
        </p>
    </div>

    {{-- RESUMEN NUMÉRICO --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        {{-- ASISTENCIA --}}
        <div class="bg-green-50 border border-green-200 rounded-lg p-5 text-center">
            <p class="text-sm text-green-700 font-semibold">Asistencia</p>
            <p class="text-3xl font-bold text-green-800">
                {{ $porcAsistencia }}%
            </p>
        </div>

        {{-- PUNTUAL --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-center">
            <p class="text-sm text-blue-700 font-semibold">Puntualidad</p>
            <p class="text-3xl font-bold text-blue-800">
                {{ $porcPuntualidad }}%
            </p>
        </div>

        {{-- TARDANZA --}}
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 text-center">
            <p class="text-sm text-yellow-700 font-semibold">Tardanzas</p>
            <p class="text-3xl font-bold text-yellow-800">
                {{ $porcTardanza }}%
            </p>
        </div>

        {{-- AUSENCIA --}}
        <div class="bg-red-50 border border-red-200 rounded-lg p-5 text-center">
            <p class="text-sm text-red-700 font-semibold">Ausentismo</p>
            <p class="text-3xl font-bold text-red-800">
                {{ $porcAusentismo }}%
            </p>
        </div>
    </div>

    {{-- DETALLE --}}
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-center">Total Días</th>
                    <th class="p-3 text-center">Puntual</th>
                    <th class="p-3 text-center">Tardanza</th>
                    <th class="p-3 text-center">Faltas</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t text-center">
                    <td class="p-3">{{ $totalDias }}</td>
                    <td class="p-3">{{ $puntual }}</td>
                    <td class="p-3">{{ $tardanza }}</td>
                    <td class="p-3">{{ $falta }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- BOTÓN --}}
    <div class="flex justify-end mt-6">
        <a href="{{ route('estudiantes.show', $estudiante->Id_estudiante) }}"
           class="px-5 py-2 bg-gray-200 rounded hover:bg-gray-300">
            Volver
        </a>
    </div>

</div>
@endsection
