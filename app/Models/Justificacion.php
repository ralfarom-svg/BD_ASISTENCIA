<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
    protected $table = 'justificacion';
    protected $primaryKey = 'id_justificacion';
    public $timestamps = false;

    protected $fillable = [
        'id_justificacion',
        'rutaArchivo',
        'fecha_envio',
        'estado',
        'motivo',
        'ID_asistencia',
        'id_auxiliar',
        'observacion_auxiliar'
    ];

    protected $casts = [
        'fecha_envio' => 'datetime'
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'ID_asistencia');
    }

    public function auxiliar()
    {
        return $this->belongsTo(Usuario::class, 'id_auxiliar');
    }

    public function revisiones()
    {
        return $this->hasMany(RevisionJustificacion::class, 'id_justificacion');
    }
    public function revision()
    {
        return $this->hasOne(RevisionJustificacion::class, 'id_justificacion', 'id_justificacion');
    }
}
