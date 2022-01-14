<?php

namespace App;

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
        'ip_pbx', 'media_server', 'Cat_Base_Datos_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_IP_PBX';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion muchos a muchos con Cat_Nas
     */
    public function cat_nas()
    {
        return $this->belongsToMany('App\Cat_NAS', 'Cat_IP_PBX_Cat_Nas', 'Cat_IP_PBX_id', 'Cat_Nas_id');
    }
    /**
     * Relacion muchos a uno con Base de Datos
     */
    public function BaseDatos()
    {
        return $this->belongsTo('App\BaseDatos', 'Cat_Base_Datos_id');
    }
}
