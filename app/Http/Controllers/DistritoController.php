<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Distrito;
use App\Models\Justificacion;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    public function index()
    {
        return response()->json(Distrito::all());
    }

    public function store(Request $request)
    {
        $distrito = Distrito::create($request->all());
        return response()->json($distrito, 201);
    }

    public function show($id)
    {
        return response()->json(Distrito::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $distrito = Distrito::findOrFail($id);
        $distrito->update($request->all());
        return response()->json($distrito);
    }

    public function destroy($id)
    {
        Distrito::destroy($id);
        return response()->json(['message' => 'Distrito eliminado']);
    }

    public function reporteGeneral(Request $request)
    {
        $fechaInicio = $request->fecha_inicio ?? Carbon::today()->toDateString();
        $fechaFin = $request->fecha_fin ?? Carbon::today()->toDateString();

        // Filtrar asistencias del rango
        $asistencias = Asistencia::with('estudiante')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        // Por grado
        $grados = $asistencias->pluck('estudiante.grado')->unique();
        $asistenciaGrado = $grados->mapWithKeys(function($grado) use ($asistencias) {
            $total = $asistencias->where('estudiante.grado', $grado)->count();
            $presentes = $asistencias->where('estudiante.grado', $grado)->where('estado_Asist','Asistió')->count();
            return [$grado => $total ? round(($presentes/$total)*100,2) : 0];
        });

        $tardanzaGrado = $grados->mapWithKeys(function($grado) use ($asistencias) {
            $total = $asistencias->where('estudiante.grado', $grado)->count();
            $tardanzas = $asistencias->where('estudiante.grado', $grado)->where('estado_Asist','Tardanza')->count();
            return [$grado => $total ? round(($tardanzas/$total)*100,2) : 0];
        });

        $ausenciaGrado = $grados->mapWithKeys(function($grado) use ($asistencias) {
            $total = $asistencias->where('estudiante.grado', $grado)->count();
            $ausentes = $asistencias->where('estudiante.grado', $grado)->where('estado_Asist','Falta')->count();
            return [$grado => $total ? round(($ausentes/$total)*100,2) : 0];
        });

        // Por sexo
        $sexoData = $asistencias->groupBy('estudiante.sexo')->map(function($items){
            return round(($items->count()/count($items))*100,2);
        });

        // Por distrito
        $distritoData = $asistencias->groupBy('estudiante.distrito')->map(function($items){
            return round(($items->count()/count($items))*100,2);
        });

        // Justificaciones
        $justificaciones = Justificacion::whereBetween('fecha_envio', [$fechaInicio, $fechaFin])
            ->get()
            ->groupBy('asistencia.estudiante.grado')
            ->map(function($items) use ($asistencias){
                $total = $items->count();
                return $total ? round(($total/count($asistencias))*100,2) : 0;
            });

        return view('director.reporte_general', [
            'asistenciaGrado' => ['labels'=>$asistenciaGrado->keys(), 'data'=>$asistenciaGrado->values()],
            'tardanzaGrado' => ['labels'=>$tardanzaGrado->keys(), 'data'=>$tardanzaGrado->values()],
            'ausenciaGrado' => ['labels'=>$ausenciaGrado->keys(), 'data'=>$ausenciaGrado->values()],
            'sexo' => ['labels'=>$sexoData->keys(), 'data'=>$sexoData->values()],
            'distrito' => ['labels'=>$distritoData->keys(), 'data'=>$distritoData->values()],
            'justificaciones' => ['labels'=>$justificaciones->keys(), 'data'=>$justificaciones->values()],
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ]);
    }
}
