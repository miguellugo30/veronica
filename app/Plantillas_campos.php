<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantillas_campos extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id',
        'fk_campos_plantilla_empresa_empresas_id',
        'fk_cat_plantilla_id',
        'editable',
        'marcar',
        'mostrar',
        'orden',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Plantillas_campos';
    /**
     * Función para obtener solo los registros activos
     */
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion muchos a uno con Cat_Plantilla
     */
    public function Cat_Plantilla()
    {
        return $this->belongsTo('App\Cat_plantilla', 'id', 'fk_cat_plantilla_id');
    }
}
