<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crd_Asignacion_Agente extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uniqueid', 'canal','Cdr_call_center_detalles_id','Empresas_id',
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
        return $this->belongsTo('App\Crd_Call_Center_Detalles', 'Cdr_call_center_detalles_id', 'id');
    }
    /**
     * Muchos a uno con Empresas
     */
    public function Agentes()
    {
        return $this->belongsTo('App\Agentes', 'Agentes_id', 'id');
    }
}
