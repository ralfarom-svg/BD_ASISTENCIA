<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionJustificacion extends Model
{
    protected $table = 'revision_justificacion';
    protected $primaryKey = 'id_revision';
    public $timestamps = false;

    protected $fillable = [
        'id_revision',
        'fecha_revision',
        'resultado',
        'observacion',
        'id_director',
        'id_justificacion'
    ];

    protected $casts = [
        'fecha_revision' => 'datetime'
    ];

    public function director()
    {
        return $this->belongsTo(Usuario::class, 'id_director');
    }

    public function justificacion()
    {
        return $this->belongsTo(Justificacion::class, 'id_justificacion');
    }
}
