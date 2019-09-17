<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grupo_Calificacion extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];
    /**
    ## Tabla a relacionar
    **/
    protected $table = 'Grupo_Calificacion';

    /**
    ## Relacion uno a muchos con CAlificaciones
    **/
    public function Calificaciones()
    {
        return $this->hasMany('Nimbus\Calificaciones');
    }
    
    //
}
