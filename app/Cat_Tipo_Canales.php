<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Tipo_Canales extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados por el usuario
     */
    protected $fillable = [
        'nombre', 'prefijo','Cat_Distribuidor_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Tipo_Canales';
    /**
     * Relacion de tipo de canal con la tabla Cat_Distribuidor
     *
     * @return void
     */
    public function Cat_Distribuidor()
    {
        return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
    /**
    * Relacion uno a uno con Canales
    */
    public function Canales()
    {
        return $this->hasOne('Nimbus\Canales', 'Cat_Tipo_Canales_id','id');
    }
}
