<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Monitoreo extends Model
{
        /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'destino', 'canal', 'fecha', 'canal_monitorea', 'Empresas_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Monitoreo';
}
