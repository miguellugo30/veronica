<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class BaseDatos extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'nombre', 'ip', 'ubicacion',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Base_Datos';
    /**
     * Relacion uno a muchos con IP_PBX
     */
    public function PBX()
    {
        return $this->hasMany('Nimbus\Cat_IP_PBX');
    }
    /**
     * Relacion uno a uno con Config Empresas
     */
    public function Config_Empresas()
    {
        return $this->hasOne('Nimbus\Config_Empresas', 'Cat_IP_PBX_id', 'id');
    }
}
