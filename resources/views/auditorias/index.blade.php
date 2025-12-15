@extends('layouts.app')

@section('title', 'Auditorías del Sistema')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- Encabezado --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-orange-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
            </svg>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Auditorías del Sistema</h1>
            <p class="text-sm text-gray-500">Historial y seguimiento de actividades del sistema</p>
        </div>
    </div>

    {{-- FILTROS --}}
    <form method="GET" class="bg-white p-4 rounded-lg shadow mb-6 grid grid-cols-1 md:grid-cols-6 gap-4 items-end text-sm">

        <input type="text" name="tabla" value="{{ request('tabla') }}" placeholder="Tabla afectada"
               class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">

        <select name="accion" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
            <option value="">Todas las acciones</option>
            <option value="CREAR" {{ request('accion')=='CREAR'?'selected':'' }}>CREAR</option>
            <option value="ACTUALIZAR" {{ request('accion')=='ACTUALIZAR'?'selected':'' }}>ACTUALIZAR</option>
            <option value="EDITAR" {{ request('accion')=='EDITAR'?'selected':'' }}>EDITAR</option>
            <option value="ELIMINAR" {{ request('accion')=='ELIMINAR'?'selected':'' }}>ELIMINAR</option>
        </select>

        <input type="date" name="fecha" value="{{ request('fecha') }}" placeholder="Fecha"
               class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por usuario"
               class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">

        <button type="submit" class="bg-orange-600 text-white rounded-lg px-4 py-2 font-semibold hover:bg-orange-700">
            Filtrar
        </button>

        @if(request()->filled('tabla') || request()->filled('accion') || request()->filled('fecha') || request()->filled('search'))
            <a href="{{ route('auditorias.index') }}"
               class="bg-gray-500 text-white rounded-lg px-4 py-2 font-semibold hover:bg-gray-600 text-center">
                Limpiar filtros
            </a>
        @endif

    </form>

    {{-- TABLA --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tabla</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Acción</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Registro</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Dispositivo</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Ver</th>
                </tr>
            </thead>
                </tr>
            </thead>
            <tbody>
                @forelse($auditorias as $a)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ \Carbon\Carbon::parse($a->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-3 text-left text-xs font-bold uppercase">{{ $a->usuario->nombre ?? 'Sistema' }}</td>
                        <td class="px-6 py-3 text-left text-xs font-bold uppercase">{{ $a->tabla_afectada }}</td>
                        <td class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($a->accion=='CREAR') bg-green-100 text-green-700
                                @elseif($a->accion=='ACTUALIZAR') bg-yellow-100 text-yellow-700
                                @elseif($a->accion=='EDITAR') bg-blue-100 text-blue-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $a->accion }}
                            </span>
                        </td>
                        <td class="p-3 text-center">#{{ $a->registro_id }}</td>
                        <td class="p-3 text-center text-xs text-gray-600">{{ \Illuminate\Support\Str::limit($a->user_agent, 40) }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('auditorias.show', $a->id) }}" class="text-orange-600 font-semibold hover:underline">
                                Detalle
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">No hay auditorías registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINACIÓN --}}
    <div class="mt-6">
        {{ $auditorias->withQueryString()->links() }}
    </div>
</div>
@endsection
