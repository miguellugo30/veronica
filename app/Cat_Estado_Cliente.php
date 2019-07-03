<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Estado_Cliente extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion', 'marcar', 'mostrar_agente', 'parametrizar', 'orden'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Estado_Cliente';
}
