<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Campos extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'nombre_campo', 'tipo_campo', 'opcines', 'tamano', 'obligatorio', 'prioridad', 'bnd_bloque', 'bnd_campo', 'num_posicion', 'editable',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Campos';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion uno a muchos con Formularios_campos
     */
    public function Formularios()
    {
        return $this->belongsToMany('Nimbus\Formularios', 'Formularios_Campos');
    }
}
