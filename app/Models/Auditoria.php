<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditorias';

    public $timestamps = false; // solo usamos created_at

    protected $fillable = [
        'id_usuario',
        'tabla_afectada',
        'registro_id',
        'accion',
        'cambios',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'cambios' => 'array',
    ];

    // Relación con USUARIO
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
