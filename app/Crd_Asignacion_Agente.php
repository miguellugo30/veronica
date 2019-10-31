<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Crd_Asignacion_Agente extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uniqueid','Cdr_call_center_detalles_id','Empresas_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cdr_Asignacion_Agente';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Empresas
     */
    public function CDR_Detalles()
    {
        return $this->belongsTo('Nimbus\Crd_Call_Center_Detalles', 'Cdr_call_center_detalles_id', 'id');
    }
    /**
     * Muchos a uno con Empresas
     */
    public function Agentes()
    {
        return $this->belongsTo('Nimbus\Agentes', 'Agentes_id', 'id');
    }
}
