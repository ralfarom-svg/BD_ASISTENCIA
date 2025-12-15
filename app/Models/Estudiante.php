<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'Id_estudiante';
    public $timestamps = false;

    protected $fillable = [
        'Id_estudiante',
        'dni',
        'nombres',
        'apellidos',
        'edad',
        'genero',
        'direccion',
        'grado',
        'seccion',
        'discapacidad',
        'tipo_discap',
        'estado',
        'codigo_qr',
        'telefono',
        'id_distrito',
        'foto',
        'fecha_registro'
    ];

    protected $casts = [
        'discapacidad' => 'boolean',
        'fecha_registro' => 'datetime'
    ];

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'Id_estudiante');
    }

    public function apoderados()
    {
        return $this->belongsToMany(
            Apoderado::class,
            'estudiante_apoderado',
            'Id_estudiante',
            'id_apoderado'
        )->withPivot(['parentesco', 'fecha_registro', 'es_principal_', 'id_e_p']);
    }

    public function resumenes()
    {
        return $this->hasMany(ResumenEstudiante::class, 'Id_estudiante');
    }
}
