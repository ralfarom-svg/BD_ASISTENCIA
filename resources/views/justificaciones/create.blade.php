@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-6 py-8">

    {{-- TARJETA --}}
    <div class="bg-white rounded-xl shadow-lg p-6">

        {{-- TÍTULO --}}
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                Envío de Justificación
            </h2>
            <p class="text-sm text-gray-500">
                La justificación será evaluada por el Director Académico.
            </p>
        </div>
        {{-- MENSAJE DE ÉXITO --}}
        @if(session('success'))
        <div class="mb-5 flex items-start gap-3
                bg-green-50 border border-green-200
                text-green-800 px-4 py-3 rounded-lg text-sm">
            <svg class="w-5 h-5 mt-0.5 text-green-600" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
            <div>
                <p class="font-semibold">Justificación registrada correctamente</p>
                <p class="text-xs text-green-700">
                    El documento fue enviado y se encuentra pendiente de aprobación.
                </p>
            </div>
        </div>
        @endif

        {{-- FORM --}}
        <form method="POST"
            action="{{ route('justificaciones.store') }}"
            enctype="multipart/form-data"
            class="space-y-5">

            @csrf

            <input type="hidden" name="ID_asistencia" value="{{ $asistencia->ID_asistencia }}">

            {{-- MOTIVO --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Motivo de la justificación
                </label>
                <input type="text"
                    name="motivo"
                    required
                    class="w-full border rounded-md px-3 py-2 text-sm
                              focus:ring-2 focus:ring-orange-500 focus:outline-none">
            </div>

            {{-- ARCHIVO --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Documento de sustento (PDF / JPG)
                </label>
                <input type="file"
                    name="archivo"
                    required
                    class="w-full border rounded-md px-3 py-2 text-sm">
            </div>

            {{-- OBSERVACIÓN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Observación adicional (opcional)
                </label>
                <textarea name="observacion_auxiliar"
                    rows="3"
                    class="w-full border rounded-md px-3 py-2 text-sm
                                 focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('asistencias.index') }}"
                    class="px-4 py-2 text-sm rounded-md
                          bg-gray-200 hover:bg-gray-300 text-gray-700">
                    Cancelar
                </a>

                <button type="submit"
                    class="px-6 py-2 text-sm rounded-md
                               bg-orange-600 hover:bg-orange-700
                               text-white font-semibold transition">
                    Enviar justificación
                </button>
            </div>

        </form>
    </div>

</div>
@endsection