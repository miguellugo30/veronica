<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrefijosMarcacion extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;

    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion' , 'prefijo', 'prefijo_nuevo', 'fk_empresas_id', 'activo',
     ];

     /**
     * Nombre de la tabla
     */
    protected $table = 'Prefijos_marcacion';

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
    * Relacion muchos a uno con Distribuidores
    */
    public function Empresas()
    {
       return $this->belongsTo('App\Empresas', 'fk_empresas_id');
    }
    /**
     * Relacion uno a muchos con Perfil_marcacion
     */
    public function Perfil_marcacion()
    {
        return $this->hasMany('App\Perfil_marcacion');
    }

}
