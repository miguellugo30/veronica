<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Plantilla extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     **/
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     **/
    protected $fillable = [
        'nombre', 'fk_empresas_id',
    ];
    /**
     * Nombre de la tabla
     **/
    protected $table = 'Cat_plantilla';
     /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
     /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('fk_empresas_id', $empresa);
    }
     /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |-----------------------------------------------------------------------
    /**
     * Relación muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'fk_empresas_id','id');
    }
}
