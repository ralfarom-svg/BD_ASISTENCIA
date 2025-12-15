<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{


    /**
     * Mostrar listado de auditorías
     */
    public function index(Request $request)
    {
        // SOLO DIRECTOR (id_rol = 3)
        if (!session()->has('usuario_id') || session('id_rol') != 3) {
            abort(403, 'No autorizado');
        }

        // Validación de filtros
        $request->validate([
            'tabla' => 'nullable|string|max:255',
            'accion' => 'nullable|in:CREAR,ACTUALIZAR,EDITAR,ELIMINAR',
            'fecha' => 'nullable|date',
            'search' => 'nullable|string|max:255',
        ]);

        // Consulta base
        $query = Auditoria::with('usuario')->orderBy('created_at', 'desc');

        // Filtros condicionales
        if ($request->filled('tabla')) {
            $query->where('tabla_afectada', 'like', '%' . $request->tabla . '%');
        }

        if ($request->filled('accion')) {
            $query->where('accion', $request->accion);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('created_at', $request->fecha);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('usuario', function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%");
            });
        }

        $auditorias = $query->paginate(15);

        return view('auditorias.index', compact('auditorias'));
    }





    /**
     * Mostrar detalle de una auditoría
     */
    public function show($id)
    {
        if (!session()->has('usuario_id') || session('id_rol') != 3) {
            abort(403, 'No autorizado');
        }

        $auditoria = Auditoria::with('usuario')->findOrFail($id);

        return view('auditorias.show', compact('auditoria'));
    }
}
