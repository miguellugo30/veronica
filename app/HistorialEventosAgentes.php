<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialEventosAgentes extends Model
{
        /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'fk_agentes_id', 'fk_cat_estado_agente_id', 'monitoreo', 'fecha_registro', 'id_sesion', 'id_fecha', 'id_tiempo_sec', 'tiempo_estado',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Historico_estado_agentes';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Uno a muchos con Grupos_Agentes
     */
    public function Agentes()
    {
        return $this->belongsTo('App\Agentes', 'fk_agentes_id', 'id');
    }
    /**
     * Uno a muchos con Grupos_Agentes
     */
    public function Cat_Estado_Agente()
    {
        return $this->belongsTo('App\Cat_Estado_Agente', 'fk_cat_estado_agente_id', 'id');
    }
}
