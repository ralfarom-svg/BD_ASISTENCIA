<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Justificacion;
use App\Models\Distrito;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function reporteGeneral(Request $request)
    {
        $fechaInicio = $request->fecha_inicio ?? Carbon::today()->toDateString();
        $fechaFin = $request->fecha_fin ?? Carbon::today()->toDateString();

        // Traer asistencias con estudiante y distrito
        $asistencias = Asistencia::with(['estudiante.distrito'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        $totalAsistencias = $asistencias->count();

        // Por grado
        $grados = $asistencias->pluck('estudiante.grado')->unique();
        $asistenciaGrado = $grados->mapWithKeys(function($grado) use ($asistencias) {
            $total = $asistencias->where('estudiante.grado', $grado)->count();
            $presentes = $asistencias->where('estudiante.grado', $grado)
                                     ->where('estado_Asist','Asistió')->count();
            return [$grado => $total ? round(($presentes/$total)*100,2) : 0];
        });

        $tardanzaGrado = $grados->mapWithKeys(function($grado) use ($asistencias) {
            $total = $asistencias->where('estudiante.grado', $grado)->count();
            $tardanzas = $asistencias->where('estudiante.grado', $grado)
                                     ->where('estado_Asist','Tardanza')->count();
            return [$grado => $total ? round(($tardanzas/$total)*100,2) : 0];
        });

        $ausenciaGrado = $grados->mapWithKeys(function($grado) use ($asistencias) {
            $total = $asistencias->where('estudiante.grado', $grado)->count();
            $ausentes = $asistencias->where('estudiante.grado', $grado)
                                     ->where('estado_Asist','Falta')->count();
            return [$grado => $total ? round(($ausentes/$total)*100,2) : 0];
        });

        // Por sexo
        $sexoData = $asistencias->groupBy('estudiante.genero')->map(function($items) use ($totalAsistencias) {
            return $totalAsistencias ? round(($items->count() / $totalAsistencias) * 100,2) : 0;
        });

        // Por distrito
        $distritoData = $asistencias->groupBy(function($item){
            return $item->estudiante->distrito->nombre ?? 'Sin distrito';
        })->map(function($items) use ($totalAsistencias) {
            return $totalAsistencias ? round(($items->count() / $totalAsistencias) * 100,2) : 0;
        });

        $distritos = Distrito::all(); // Para select en la vista

        // Justificaciones
        $justificaciones = Justificacion::with('asistencia.estudiante')
            ->whereBetween('fecha_envio', [$fechaInicio, $fechaFin])
            ->get()
            ->groupBy(function($item){
                return $item->asistencia->estudiante->grado ?? 'Sin grado';
            })
            ->map(function($items) use ($totalAsistencias){
                return $totalAsistencias ? round(($items->count() / $totalAsistencias) * 100,2) : 0;
            });

        return view('director.reporte_general', [
            'asistenciaGrado' => ['labels'=>$asistenciaGrado->keys(), 'data'=>$asistenciaGrado->values()],
            'tardanzaGrado' => ['labels'=>$tardanzaGrado->keys(), 'data'=>$tardanzaGrado->values()],
            'ausenciaGrado' => ['labels'=>$ausenciaGrado->keys(), 'data'=>$ausenciaGrado->values()],
            'sexo' => ['labels'=>$sexoData->keys(), 'data'=>$sexoData->values()],
            'distrito' => ['labels'=>$distritoData->keys(), 'data'=>$distritoData->values()],
            'justificaciones' => ['labels'=>$justificaciones->keys(), 'data'=>$justificaciones->values()],
            'distritos' => $distritos,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ]);
    }
}
