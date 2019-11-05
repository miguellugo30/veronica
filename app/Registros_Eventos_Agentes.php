<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Registros_Eventos_Agentes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fecha_inicio', 'fecha_fin','Eventos_Agentes_id','Agentes_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Registros_Eventos_Agentes';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Empresas
     */
    public function Eventos_agentes()
    {
        return $this->belongsTo('Nimbus\Eventos_Agentes', 'Eventos_Agentes_id', 'id');
    }
    /**
     * Muchos a uno con Empresas
     */
    public function Agentes()
    {
        return $this->belongsTo('Nimbus\Agentes', 'Agentes_id', 'id');
    }
}
