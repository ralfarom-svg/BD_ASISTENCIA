@extends('layouts.app')

@section('title', 'Listado de Estudiantes')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Listado de Estudiantes
        </h1>

        {{-- BOTÓN REGISTRAR --}}
        <a href="{{ route('estudiantes.create') }}"
            class="bg-orange-100 text-orange-700 px-5 py-2 rounded-full
                  font-semibold border border-orange-300 hover:bg-orange-200 transition">
            + Registrar Estudiante
        </a>
    </div>

    {{-- FILTROS + BUSCADOR --}}
    <div class="bg-white shadow-xl rounded-2xl p-4 mb-6">
        <form method="GET" class="flex flex-wrap items-center gap-3 text-sm">

            {{-- Estado --}}
            <select name="estado"
                class="h-10 px-4 cursor-pointer rounded-lg border border-gray-300
                           focus:border-orange-500 focus:ring focus:ring-orange-200">
                <option value="">Todos los Estados</option>
                <option value="Activo" {{ request('estado') === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Retirado" {{ request('estado') === 'Retirado' ? 'selected' : '' }}>Retirado</option>
            </select>

            {{-- Grado --}}
            <select name="grado"
                class="h-10 px-4 cursor-pointer rounded-lg border border-gray-300
                           focus:border-orange-500 focus:ring focus:ring-orange-200">
                <option value="">Todos los Grados</option>
                @foreach($grados as $g)
                <option value="{{ $g }}" {{ request('grado') === $g ? 'selected' : '' }}>{{ $g }}</option>
                @endforeach
            </select>

            {{-- Sección --}}
            <select name="seccion"
                class="h-10 px-4 cursor-pointer rounded-lg border border-gray-300
                           focus:border-orange-500 focus:ring focus:ring-orange-200">
                <option value="">Todas las Secciones</option>
                @foreach($secciones as $s)
                <option value="{{ $s }}" {{ request('seccion') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>

            {{-- Buscador --}}
            <input type="text" name="search" placeholder="Buscar por nombre, apellido o DNI"
                value="{{ request('search') }}"
                class="h-10 px-4 rounded-lg border border-gray-300 w-full md:w-64
                          focus:border-orange-500 focus:ring focus:ring-orange-200">

            {{-- Botones --}}
            <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer">
                Filtrar
            </button>

            @if(request()->hasAny(['estado','grado','seccion','search']))
            <a href="{{ route('estudiantes.index') }}"
                class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                Limpiar
            </a>
            @endif
        </form>
    </div>

    {{-- TABLA --}}
    <div class="bg-white shadow-xl rounded-2xl overflow-x-auto">

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">DNI</th>
                    <th class="px-6 py-4">Nombre Completo</th>
                    <th class="px-6 py-4">Grado</th>
                    <th class="px-6 py-4">Estado</th>
                    <th class="px-6 py-4 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($estudiantes as $e)
                <tr class="transition {{ $e->estado === 'Retirado' ? 'bg-red-50 hover:bg-red-100' : 'hover:bg-gray-50' }}">

                    {{-- FOTO --}}
                    <td class="px-6 py-4">
                        @if($e->foto)
                        <img src="{{ asset('storage/'.$e->foto) }}" alt="Foto" class="w-12 h-12 object-cover rounded-full shadow">
                        @else
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full text-gray-500">
                            👤
                        </div>
                        @endif
                    </td>

                    {{-- DNI --}}
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $e->dni }}</td>

                    {{-- NOMBRE --}}
                    <td class="px-6 py-4">
                        <p class="font-semibold text-gray-800">{{ $e->nombres }} {{ $e->apellidos }}</p>
                    </td>

                    {{-- GRADO --}}
                    <td class="px-6 py-4">{{ $e->grado }} {{ $e->seccion }}</td>

                    {{-- ESTADO --}}
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $e->estado === 'Activo' ? 'bg-green-100 text-green-700' : 'bg-red-200 text-red-700' }}">
                            {{ $e->estado }}
                        </span>
                    </td>

                    {{-- ACCIONES --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2 flex-wrap">
                            <a href="{{ route('estudiantes.show', $e->Id_estudiante) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow">
                                Ver
                            </a>

                            <a href="{{ route('estudiantes.edit', $e->Id_estudiante) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">
                                Editar
                            </a>

                            @if($e->estado === 'Activo')
                            <button type="button" onclick="openRetirarModal({{ $e->Id_estudiante }})"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow">
                                Retirar
                            </button>
                            <form id="form-retirar-{{ $e->Id_estudiante }}"
                                action="{{ route('estudiantes.destroy', $e->Id_estudiante) }}"
                                method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">No hay estudiantes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINACIÓN --}}
    <div class="mt-6">
        {{ $estudiantes->withQueryString()->links() }}
    </div>

</div>

{{-- MODAL RETIRAR --}}
<div id="modalRetirar" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-xl text-center font-bold text-gray-800 mb-4">⚠️ Confirmar retiro</h3>
        <p class="text-gray-600 mb-6">
            ¿Estás seguro que deseas marcar a este estudiante como
            <span class="font-semibold text-red-600">RETIRADO</span>?
            <br>
            <span class="text-sm text-gray-500">(El estudiante no se eliminará, solo cambiará su estado)</span>
        </p>
        <div class="flex justify-end gap-3">
            <button onclick="closeRetirarModal()" class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">Cancelar</button>
            <button id="btnConfirmarRetiro" class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">Sí, retirar</button>
        </div>
    </div>
</div>

<script>
    let formId = null;

    function openRetirarModal(id) {
        formId = id;
        document.getElementById('modalRetirar').classList.remove('hidden');
        document.getElementById('modalRetirar').classList.add('flex');
    }

    function closeRetirarModal() {
        document.getElementById('modalRetirar').classList.add('hidden');
        document.getElementById('modalRetirar').classList.remove('flex');
    }

    document.getElementById('btnConfirmarRetiro').addEventListener('click', function() {
        if (formId) {
            document.getElementById(`form-retirar-${formId}`).submit();
        }
    });
</script>
@endsection