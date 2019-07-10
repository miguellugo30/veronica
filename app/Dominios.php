<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Dominios extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'dominio', 'dominio_bria',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Dominios';
}
