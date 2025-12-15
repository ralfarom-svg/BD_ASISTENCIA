<?php

namespace App\Observers;

use App\Models\Estudiante;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Auth;

class EstudianteObserver
{
    /**
     * Se ejecuta cuando se CREA un estudiante
     */
    public function created(Estudiante $estudiante): void
    {
        Auditoria::create([
            'id_usuario' => session('usuario_id'),
            'tabla_afectada' => 'estudiantes',
            'registro_id' => $estudiante->Id_estudiante,
            'accion' => 'CREAR',
            'cambios' => [
                'nuevo' => $estudiante->getAttributes()
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Se ejecuta cuando se ACTUALIZA un estudiante
     */
    public function updated(Estudiante $estudiante): void
    {
        Auditoria::create([
            'id_usuario' => session('usuario_id'),
            'tabla_afectada' => 'estudiantes',
            'registro_id' => $estudiante->Id_estudiante,
            'accion' => 'EDITAR',
            'cambios' => [
                'antes' => $estudiante->getOriginal(),
                'despues' => $estudiante->getAttributes(),
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }


    public function deleted(Estudiante $estudiante): void
    {
        Auditoria::create([
            'id_usuario' => session('usuario_id'),
            'tabla_afectada' => 'estudiantes',
            'registro_id' => $estudiante->Id_estudiante,
            'accion' => 'ELIMINAR',
            'cambios' => [
                'antes' => $estudiante->getOriginal()
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
