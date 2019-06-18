<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_IP_PBX extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'ip_pbx', 'media_server',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_IP_PBX';
}
