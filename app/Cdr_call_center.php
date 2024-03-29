<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cdr_call_center extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'tipo', 'uniqueid','callerid','calledid','fecha_inicio','fecha_fin', 'hangup', 'Empresas_id', 'canal'
    ];
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
        return $this->belongsToMany('App\Cdr_call_center_detalles', 'uniqueid');
    }
}
