<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Campos_Plantillas extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_campos_plantillas';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion muchos a muchos con Empresas
     */
    public function Empresas()
    {
        return $this->belongsToMany('Nimbus\Empresas', 'Campos_plantillas_empresa', 'fk_cat_campos_plantilla_id', 'fk_empresas_id');
    }
    /**
     * Relación muchos a uno con Empresas
     */
    public function Registros_base()
    {
        return $this->hasMany('Nimbus\Registros_base', 'fk_cat_campos_plantilla_id','id');
    }
}
