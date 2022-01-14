<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opciones_Speech extends Model
{
    //
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'tipo', 'nombre', 'speech_id_hijo', 'speech_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Opciones_Speech';
    /**
     * Función para obtener solo los registros activos
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
        return $this->belongsTo('App\speech');
     }
}
