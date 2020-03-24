<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
  /*
   * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
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
     * Función para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
     * Función para obtener solo los registros de una empresa
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('fk_empresas_id', (int)$empresa);
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relación uno a muchos con Perfil_marcacion
     */
    public function Perfil_marcacion()
    {
        return $this->hasMany('Nimbus\Perfil_marcacion');
    }

}
