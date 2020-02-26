<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Registros_base extends Model
{
    /**
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'fk_cat_campos_plantilla_id',
        'fk_cat_plantilla_id',
        'fk_bases_datos',
        'valor',
        'fecha_registro',
        'fecha_actualizacion',
        'fecha_baja',
        'activo',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Registros_base';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |-----------------------------------------------------------------------
    /**
     * Relacion muchos a uno con Cat_plantillas
     */
    public function Cat_Plantilla()
    {
        return $this->belongsTo('Nimbus\Cat_plantilla', 'id', 'fk_cat_plantilla_id');
    }
    /**
     * Relacion muchos a uno con Bases_Datos
     */
    public function Bases_Datos()
    {
        return $this->belongsTo('Nimbus\Bases_Datos', 'id', 'fk_bases_datos_id');
    }
    /**
     * Relacion muchos a uno con Cat_campos_plantillas
     */
    public function Cat_campos_plantillas()
    {
        return $this->belongsTo('Nimbus\Cat_Campos_Plantillas', 'id', 'fk_cat_campos_platilla_id');
    }
    /**
     * Relación uno a muchos con Resultado_Campanas
     */
    public function Resultado_campanas()
    {
        return $this->hasMany('Nimbus\Resultado_campanas', 'fk_registro_base_id','id');
    }

}
