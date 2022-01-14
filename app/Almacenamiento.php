<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacenamiento extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'grabacioness_salida', 'grabaciones_entrada','grabaciones_manuales','buzon_voz','audios_empresa','tipo','id_dispositivo','Empresas_id'
    ];

    /**
     * Nombre de la tabla que se ocupara
     */
    protected $table = 'Almacenamiento';
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
        return $this->belongsTo('App\Empresas', 'Empresas_id','id');
    }
}
