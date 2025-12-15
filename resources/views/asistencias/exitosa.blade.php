@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center p-6">

    <div class="bg-white shadow-2xl rounded-xl border border-gray-200 p-8 max-w-md w-full text-center relative overflow-hidden">
        
        {{-- Barra decorativa superior --}}
        <div class="absolute top-0 left-0 w-full h-2 
            @if($asistencia->estado_Asist === 'PUNTUAL') bg-blue-600 
            @elseif($asistencia->estado_Asist === 'TARDANZA') bg-amber-500 
            @else bg-gray-500 
            @endif">
        </div>

        {{-- ICONO DE ESTADO (Grande y Centrado) --}}
        <div class="mb-6 flex justify-center">
            @if($asistencia->estado_Asist === 'PUNTUAL')
                <div class="h-20 w-20 bg-blue-50 rounded-full flex items-center justify-center ring-4 ring-blue-100">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            @elseif($asistencia->estado_Asist === 'TARDANZA')
                <div class="h-20 w-20 bg-amber-50 rounded-full flex items-center justify-center ring-4 ring-amber-100">
                    <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            @else
                <div class="h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center ring-4 ring-gray-200">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            @endif
        </div>

        {{-- TÍTULO DE ESTADO --}}
        <h2 class="text-2xl font-bold mb-2 tracking-tight
            @if($asistencia->estado_Asist === 'PUNTUAL') text-blue-900
            @elseif($asistencia->estado_Asist === 'TARDANZA') text-amber-700
            @else text-gray-700
            @endif">
            @if($asistencia->estado_Asist === 'PUNTUAL')
                Asistencia Registrada
            @elseif($asistencia->estado_Asist === 'TARDANZA')
                Llegada Tardía
            @else
                Ausencia Registrada
            @endif
        </h2>

        {{-- BADGE DE ESTADO (Pequeño y sutil) --}}
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-6
            @if($asistencia->estado_Asist === 'PUNTUAL') bg-blue-100 text-blue-700
            @elseif($asistencia->estado_Asist === 'TARDANZA') bg-amber-100 text-amber-700
            @else bg-gray-200 text-gray-600
            @endif">
            {{ $asistencia->estado_Asist }}
        </span>

        <hr class="border-gray-100 mb-6">

        {{-- DATOS DEL ESTUDIANTE --}}
        <div class="space-y-4">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Estudiante</p>
                <p class="text-xl font-serif text-gray-800 font-medium">
                    {{ $asistencia->estudiante->nombres }} {{ $asistencia->estudiante->apellidos }}
                </p>
            </div>

            {{-- Grid de Fecha y Hora --}}
            <div class="flex justify-center gap-4">
                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-gray-600 text-sm font-medium">{{ $fechaFormateada }}</span>
                </div>
                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-gray-600 text-sm font-medium">{{ $horaFormateada }}</span>
                </div>
            </div>
        </div>

        {{-- MENSAJE DUPLICADO (Estilo Alerta Formal) --}}
        @if($duplicado == 1)
            <div class="mt-8 flex items-start gap-3 bg-orange-50 p-4 rounded-lg border border-orange-200 text-left">
                <svg class="w-5 h-5 text-orange-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h4 class="text-sm font-bold text-orange-800">Registro Existente</h4>
                    <p class="text-xs text-orange-700 mt-1">La asistencia para el día de hoy ya había sido registrada previamente.</p>
                </div>
            </div>
        @endif

        {{-- BOTÓN DE ACCIÓN --}}
        <div class="mt-8">
            <a href="{{ route('asistencia.escanear') }}"
               class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md hover:shadow-lg">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                </span>
                Registrar Siguiente Estudiante
            </a>
        </div>

    </div>

    {{-- FOOTER PEQUEÑO --}}
    <p class="mt-8 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} Sistema de Control Académico
    </p>

</div>
@endsection