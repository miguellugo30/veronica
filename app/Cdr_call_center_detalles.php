<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cdr_call_center_detalles extends Model
{
    //
    public $timestamps = false;

    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cdr_call_center_detalles';

    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion muchos a uno con Cdr_call_center
     */
    public function Cdr_call_center()
    {
        return $this->belongsTo('Nimbus\Cdr_call_center', 'uniqueid','uniqueid');
    }




}
