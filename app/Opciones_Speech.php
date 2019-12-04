<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Opciones_Speech extends Model
{
    //
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'texto', 'prioridad', 'speech_id'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Opciones_Speech';
    /**
     * Funcion para obtener solo los registros activos
     */

    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Speech
     */
     public function Speech()
     {
         return $this->belongsTo('Nimbus\speech');
         //return $this->hasMany('Nimbus\speech');
     }
}
