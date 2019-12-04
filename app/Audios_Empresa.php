<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Audios_Empresa extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion','musica_en_espera','ruta','Empresas_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Audios_Empresa';
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


}
