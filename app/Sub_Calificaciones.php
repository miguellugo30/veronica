<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Sub_Calificaciones extends Model
{
    protected $fillable = [
        'nombre', 'Calificaciones_id', 'Formularios_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Sub_Calificaciones';
}
