<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
  /*
   * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
   */
   public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion' , 'fk_empresas_id', 'activo',
     ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Perfiles';
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
     * Relacion uno a muchos con Perfil_marcacion
     */
    public function Perfil_marcacion()
    {
        return $this->hasMany('Nimbus\Perfil_marcacion');
    }

}
