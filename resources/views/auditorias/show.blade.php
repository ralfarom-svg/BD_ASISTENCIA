@extends('layouts.app')

@section('title', 'Detalle de Auditoría')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    <a href="{{ route('auditorias.index') }}"
        class="inline-flex items-center mb-4 text-orange-600 hover:underline">
        ← Volver
    </a>

    <div class="flex items-center gap-3 mb-6">
        <!-- Icono SVG -->
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 17v-2a4 4 0 014-4h4m-2 6h.01M12 3a9 9 0 100 18 9 9 0 000-18z" />
            </svg>
        </div>

        <!-- Texto -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Detalle de Auditoría
            </h1>
            <p class="text-sm text-gray-500">
                Revisión detallada de eventos y cambios registrados
            </p>
        </div>
    </div>


    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <p><strong>Usuario:</strong> {{ $auditoria->usuario->nombre ?? 'Sistema' }}</p>
            <p><strong>Fecha:</strong> {{ $auditoria->created_at->format('d/m/Y H:i:s') }}</p>

            <p><strong>Tabla afectada:</strong> {{ $auditoria->tabla_afectada }}</p>
            <p><strong>Acción:</strong> {{ strtoupper($auditoria->accion) }}</p>

            <p><strong>ID del registro:</strong> {{ $auditoria->registro_id }}</p>
            <p><strong>IP:</strong> {{ $auditoria->ip_address }}</p>
        </div>

        <hr>

        <div>
            <h2 class="font-semibold mb-2">Cambios realizados</h2>
            @if($auditoria->cambios)
            <pre class="bg-gray-100 rounded text-xs overflow-x-auto">
            {{ json_encode($auditoria->cambios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
            </pre>
            @else
            <p class="text-gray-500 text-sm">No se registraron cambios detallados.</p>
            @endif
        </div>

    </div>

</div>
@endsection