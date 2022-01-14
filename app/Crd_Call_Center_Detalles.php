<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crd_Call_Center_Detalles extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uniqueid','aplicacion','id_aplicacion','fecha_inicio','fecha_fin', 'Empresas_id'
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cdr_call_center_detalles';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('App\Empresas', 'Empresas_id', 'id');
    }
    /**
     * Uno a muchos con Asignacion Agente
     */
    public function Crd_Asignacion_Agente()
    {
        return $this->hasMany('App\Crd_Asignacion_Agente', 'Cdr_call_center_detalles_id', 'id');
    }
    /**
     * Uno a muchos con CDR
     */
    public function CDR()
    {
        return $this->hasMany('App\Crd_Call_Center', 'uniqueid', 'uniqueid');
    }
}
