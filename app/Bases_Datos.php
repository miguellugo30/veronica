<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Bases_Datos extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'fk_empresas_id',
       'fk_cat_plantilla_id',
       'nombre',
       'activo',
       'fecha_creacion',
       'fecha_actualizacion',
       'fecha_baja',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Bases_datos';
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
    |--------------------------------------------------------------------------
    /**
     * Relacion uno a uno con Cat_Plantillas
     */
    public function Plantillas()
    {
        return $this->belongsTo('Nimbus\Cat_Plantilla', 'fk_cat_plantilla_id' );
    }
    /**
     * Relacion uno a uno con Config Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'fk_empresa_id','id');
    }}
