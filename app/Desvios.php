<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Desvios extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'dial','ringeo','activo','Empresas_id','Canales_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Desvios';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
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
     * Relacion muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id','id');
    }
    /**
     * Relacion uno a uno con Caneles
     */
    public function Canales()
    {
        return $this->hasOne('Nimbus\Canales', 'id', 'Canales_id');
    }
}
