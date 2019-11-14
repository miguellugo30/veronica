<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cdr_Asigancion_Agente extends Model
{
    //
    public $timestamps = false;

    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cdr_Asigancion_Agente';

    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion muchos a uno con Cdr_call_center_detalles
     */
    public function Cdr_call_center_detalles()
    {
        return $this->belongsTo('Nimbus\Cdr_call_center_detalles', 'uniqueid','uniqueid');
    }

}
