<?php

namespace App;

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
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
     * Relacion uno a muchos con IP_PBX
     */
    public function PBX()
    {
        return $this->hasMany('App\Cat_IP_PBX');
    }
    /**
     * Relacion uno a uno con Config Empresas
     */
    public function Config_Empresas()
    {
        return $this->hasOne('App\Config_Empresas', 'Cat_IP_PBX_id', 'id');
    }
}
