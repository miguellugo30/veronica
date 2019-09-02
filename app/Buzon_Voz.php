<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Buzon_Voz extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'correos','tiempo_maximo','terminacion','activo','Empresas_id','Audios_Empresa_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Buzon_Voz';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
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
    public function Audios_Empresa()
    {
        return $this->hasOne('Nimbus\Audios_Empresa', 'id', 'Audios_Empresa_id');
    }
}