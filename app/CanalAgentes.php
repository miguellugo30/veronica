<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class CanalAgentes extends Model
{
    /**
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'id', 'fk_agentes_id', 'canal',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Canal_agentes';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion uno a uno con Agentes
     */
    public function Agente()
    {
       return $this->belongsTo('Nimbus\Agentes', 'id', 'fk_agentes_id');
    }
}
