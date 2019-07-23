<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Tipo_Canales extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'nombre','prefijo','Cat_Distribuidor_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Tipo_Canales';
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
    |-----------------------------------------------------------------------
    /**
     * Relacion muchos a uno con Cat_Distribuidor
     */
    public function Cat_Distribuidor()
    {
       return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id', 'id');
    }

    /**
     * Relacion uno a uno con Canales
     */
    public function Canales()
    {
        return $this->hasOne('Nimbus\Canales', 'id', 'Cat_Tipo_Canales_id');
    }
}
