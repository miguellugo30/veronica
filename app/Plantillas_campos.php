<?php

namespace Nimbus;

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
     * Muchos a uno con Speech
     public function Speech()
     {
         return $this->belongsTo('Nimbus\speech');
        }
        */
}
