<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cdr_call_center extends Model
{
    //
    public $timestamps = false;

    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cdr_call_center';
    /**
     * Funcion para obtener solo los registros de una empresa
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('Empresas_id', $empresa);
    }

    public function scopeTipoLlamada($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion uno a muchos con Cdr_call_center_detalles
     */
    public function Cdr_call_center_detalles()
    {
        return $this->belongsToMany('Nimbus\Cdr_call_center_detalles', 'uniqueid');
    }
}
