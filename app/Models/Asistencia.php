<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencia';
    protected $primaryKey = 'ID_asistencia';
    public $timestamps = false;

    protected $fillable = [
        'ID_asistencia',
        'fecha',
        'hora_escaneo',
        'estado_Asist',
        'duplicado_',
        'Id_estudiante',
        'fecha_registro',
        'id_usuario'
    ];

    protected $casts = [
        'duplicado_' => 'boolean',
        'fecha' => 'date',
        'hora_escaneo' => 'datetime:H:i:s',
        'fecha_registro' => 'datetime'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'Id_estudiante');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function justificacion()
    {
        return $this->hasOne(Justificacion::class, 'ID_asistencia');
    }
    
}
