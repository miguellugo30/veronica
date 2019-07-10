<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'modulos';
    /**
     * Relacion muchos a muchos con Modulos
     */
    public function Empresas()
    {
        return $this->belongsToMany('Nimbus\Empresas', 'Modulos_Empresas');
    }
}
