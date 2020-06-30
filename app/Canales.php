<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canales extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'protocolo', 'prefijo' , 'Troncales_id', 'Cat_Distribuidor_id', 'Empresas_id', 'Cat_Canales_Tipo_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Canales';
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
     * Relacion uno a muchos con Did
     */
    public function Dids()
    {
        return $this->hasMany('App\Dids');
    }
    /**
    * Relacion muchos a uno con Troncales
    */
    public function Troncales()
    {
       return $this->belongsTo('App\Troncales', 'Troncales_id');
    }
    /**
    * Relacion muchos a uno con Distribuidores
    */
    public function Distribuidores()
    {
       return $this->belongsTo('App\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
    /**
    * Relacion muchos a uno con Distribuidores
    */
    public function Empresas()
    {
       return $this->belongsTo('App\Empresas', 'Empresas_id');
    }
    /**
     * Relacion uno a uno con Cat_Tipo_Canales
     */
    public function Cat_Tipo_Canales()
    {
        return $this->hasOne('App\Cat_Tipo_Canales', 'id', 'Cat_Canales_Tipo_id');
    }
    /**
     * Relacion uno a muchos con Perfil_marcacion
     */
    public function Perfil_marcacion()
    {
        return $this->hasMany('App\Perfil_marcacion', 'fk_canales_id', 'id');
    }
}
