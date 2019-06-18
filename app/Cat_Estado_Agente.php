<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Estado_Agente extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion', 'recibir_llamada',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Estado_Agente';
}
