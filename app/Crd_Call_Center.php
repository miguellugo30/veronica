<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Crd_Call_Center extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tipo', 'uniqueid','callerid','calledid','fecha_inicio','fecha_fin', 'hangup', 'Empresas_id', 'canal',
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
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
    /**
     * Uno a muchos con Empresas
     */
    public function CDR_Detalle()
    {
        return $this->hasMany('Nimbus\Crd_Call_Center_Detalles', 'uniqueid', 'uniqueid');
    }
}
