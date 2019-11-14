<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cdr_call_center extends Model
{
    //
    public $timestamps = false;

    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cdr_call_center';

    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion uno a muchos con Cdr_call_center_detalles
     */
    public function Cdr_call_center_detalles()
    {
        return $this->belongsToMany('Nimbus\Cdr_call_center_detalles', 'uniqueid');
    }
}
