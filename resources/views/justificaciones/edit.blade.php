@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-100 mt-8">
    
    <div class="mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Editar Justificación</h2>
        <p class="text-sm text-gray-500">Modifica los detalles o adjunta nueva evidencia.</p>
    </div>

    {{-- MENSAJES DE ERROR --}}
    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
        <p class="font-bold mb-1">Por favor corrige los siguientes errores:</p>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORMULARIO DE EDICIÓN --}}
    <form method="POST"
        action="{{ route('justificaciones.update', $justificacion->id_justificacion) }}"
        enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-bold text-gray-700">Motivo</label>
            <input type="text"
                name="motivo"
                value="{{ old('motivo', $justificacion->motivo) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition"
                required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-bold text-gray-700">Comentario / Observación</label>
            <textarea name="observacion_auxiliar"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition"
                rows="4">{{ old('observacion_auxiliar', $justificacion->observacion_auxiliar) }}</textarea>
        </div>

        <div class="bg-gray-50 p-3 rounded border border-gray-200">
            <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Archivo actual</label>
            @if($justificacion->rutaArchivo)
            <a href="{{ asset('storage/' . $justificacion->rutaArchivo) }}" target="_blank"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm gap-1 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                Ver documento adjunto
            </a>
            @else
            <span class="text-gray-400 text-sm italic">No hay archivo adjunto</span>
            @endif
        </div>

        <div>
            <label class="block mb-1 text-sm font-bold text-gray-700">Reemplazar archivo (Opcional)</label>
            <input type="file" name="archivo"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
                accept=".pdf,.jpg,.jpeg,.png">
            <p class="text-xs text-gray-500 mt-1">Formatos: PDF, JPG, PNG (Máx 5MB).</p>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
            
            <button type="button"
                onclick="abrirModal('modal-cancelar')"
                class="px-5 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                Cancelar
            </button>

            <button type="submit"
                class="px-5 py-2.5 bg-orange-600 text-white font-semibold rounded-lg shadow-md hover:bg-orange-700 focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                Guardar Cambios
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-200">
        
        <button type="button"
            onclick="abrirModal('modal-eliminar')"
            class="w-full flex items-center justify-center px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition-colors font-medium text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Eliminar esta justificación
        </button>
    </div>
</div>

{{-- ========================================== --}}
{{-- MODAL 1: CANCELAR EDICIÓN --}}
{{-- ========================================== --}}
<div id="modal-cancelar" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        
        <div class="fixed inset-0 bg-transparent backdrop-blur-sm transition-opacity" 
             onclick="cerrarModal('modal-cancelar')"></div>

        <div class="relative z-10 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">¿Cancelar edición?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Si sales ahora, perderás todos los cambios que no hayas guardado.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                <a href="{{ url()->previous() }}" 
                   class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none sm:w-auto sm:text-sm">
                   Sí, salir
                </a>
                <button type="button" onclick="cerrarModal('modal-cancelar')" 
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm cursor-pointer">
                    Continuar editando
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ========================================== --}}
{{-- MODAL 2: ELIMINAR JUSTIFICACIÓN --}}
{{-- ========================================== --}}
<div id="modal-eliminar" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        
        <div class="fixed inset-0 backdrop-blur-sm transition-opacity" 
             onclick="cerrarModal('modal-eliminar')"></div>

        <div class="relative z-10 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Eliminar Justificación</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro? Esta acción eliminará el registro y sus archivos adjuntos de forma <strong>permanente</strong>. No se puede deshacer.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                
                <form method="POST" action="{{ route('justificaciones.destroy', $justificacion->id_justificacion) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:w-auto sm:text-sm cursor-pointer">
                        Sí, eliminar
                    </button>
                </form>

                <button type="button" onclick="cerrarModal('modal-eliminar')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm cursor-pointer">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPTS DE CONTROL --}}
<script>
    function abrirModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function cerrarModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    // Cerrar con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            cerrarModal('modal-cancelar');
            cerrarModal('modal-eliminar');
        }
    });
</script>
@endsection