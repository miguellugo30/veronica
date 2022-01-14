<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat_NAS extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'ip_nas', 'nombre',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Nas';
}
