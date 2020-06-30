<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cdr_Asigancion_Agente extends Model
{
    //
    public $timestamps = false;
    /**
    * Campos que pueden ser modificados
    */
    protected $fillable = [
        'uniqueid', 'canal', 'fecha_respuesta', 'fecha_calificacion', 'Cdr_Call_Center_detalles_id', 'Agentes_id',
    ];
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
        return $this->belongsTo('App\Cdr_call_center_detalles', 'uniqueid','uniqueid');
    }

}
