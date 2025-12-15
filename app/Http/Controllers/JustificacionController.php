<?php

namespace App\Http\Controllers;

use App\Models\Justificacion;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JustificacionController extends Controller
{


    public function create($id_asistencia)
    {
        $asistencia = Asistencia::with('estudiante')->findOrFail($id_asistencia);
        return view('justificaciones.create', compact('asistencia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_asistencia' => 'required',
            'motivo' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $ruta = $request->file('archivo')->store('justificaciones', 'public');

        Justificacion::create([
            'rutaArchivo' => $ruta,
            'fecha_envio' => Carbon::now(),
            'estado' => 'Pendiente',
            'motivo' => $request->motivo,
            'ID_asistencia' => $request->ID_asistencia,
            'id_auxiliar' => session('usuario_id'),
            'observacion_auxiliar' => $request->observacion_auxiliar
        ]);

        return redirect()->back()->with('success', 'Justificación enviada correctamente');
    }

    public function edit($id)
    {
        $justificacion = Justificacion::findOrFail($id);

        // Determinar si es editable
        $editable = empty($justificacion->observacion_director); // true si no tiene observación

        return view('justificaciones.edit', compact('justificacion', 'editable'));
    }

    public function update(Request $request, $id)
    {
        $justificacion = Justificacion::findOrFail($id);

        $request->validate([
            'motivo' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' // Nuevo archivo opcional
        ]);

        // Si se sube un nuevo archivo, reemplazar
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo viejo si existe
            if ($justificacion->rutaArchivo && file_exists(storage_path('app/public/' . $justificacion->rutaArchivo))) {
                unlink(storage_path('app/public/' . $justificacion->rutaArchivo));
            }

            $ruta = $request->file('archivo')->store('justificaciones', 'public');
            $justificacion->rutaArchivo = $ruta;
        }

        $justificacion->motivo = $request->motivo;
        $justificacion->observacion_auxiliar = $request->observacion_auxiliar;
        $justificacion->save();

        return redirect()->back()->with('success', 'Justificación actualizada correctamente');
    }

    public function destroy($id)
    {
        $justificacion = Justificacion::findOrFail($id);

        // Eliminar archivo físico
        if ($justificacion->rutaArchivo && file_exists(storage_path('app/public/' . $justificacion->rutaArchivo))) {
            unlink(storage_path('app/public/' . $justificacion->rutaArchivo));
        }

        $justificacion->delete();

        return redirect()->route('asistencias.index')->with('success', 'Justificación eliminada correctamente');
    }
    public function show($id)
    {
        $justificacion = Justificacion::findOrFail($id);
        return view('justificaciones.show', compact('justificacion'));
    }
}
