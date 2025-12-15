@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- ENCABEZADO --}}
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Usuarios del Sistema</h2>
        <a href="{{ route('usuarios.create') }}"
           class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-md font-semibold text-sm shadow transition-colors">
           + Crear Usuario
        </a>
    </div>

    {{-- TABLA DE USUARIOS --}}
    <div class="bg-white shadow rounded-lg overflow-x-auto border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Correo</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Activo</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Último acceso</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($usuarios as $usuario)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $usuario->correo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $usuario->rol->nombre_rol ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($usuario->activo_)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">Activo</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $usuario->ult_acceso ? $usuario->ult_acceso->format('d/m/Y H:i') : 'No hay último acceso' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap flex justify-center gap-2">
                            <a href="{{ route('usuarios.show', $usuario->id_usuario) }}"
                               class="px-3 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors">Ver</a>
                            
                            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}"
                               class="px-3 py-1 text-sm bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm transition-colors">Editar</a>
                            
                            {{-- BOTÓN ELIMINAR --}}
                            <button type="button"
                                    onclick="abrirModalEliminar('{{ route('usuarios.destroy', $usuario->id_usuario) }}')"
                                    class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-md shadow-sm transition-colors cursor-pointer">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            No hay usuarios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL DE ELIMINACIÓN CON EFECTO NUBLADO (BLUR) --}}
<div id="modalEliminar" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        
        <div class="fixed inset-0 bg-transparent bg-opacity-50 backdrop-blur-md transition-opacity"
     aria-hidden="true"
     onclick="cerrarModalEliminar()"></div>


        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="relative z-10 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Eliminar Usuario
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro de que deseas eliminar este usuario? El registro desaparecerá permanentemente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="formEliminarSubmit" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                        Sí, eliminar
                    </button>
                </form>
                
                <button type="button" onclick="cerrarModalEliminar()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm cursor-pointer">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModalEliminar(urlDestino) {
        document.getElementById('formEliminarSubmit').action = urlDestino;
        document.getElementById('modalEliminar').classList.remove('hidden');
    }

    function cerrarModalEliminar() {
        document.getElementById('modalEliminar').classList.add('hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            cerrarModalEliminar();
        }
    });
</script>
@endsection