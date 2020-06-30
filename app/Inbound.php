<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre_archivo', 'estado','fecha','tipo','Empresas_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Grabaciones';
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
    public function Campanas()
    {
        return $this->belongsTo('App\Campanas', 'id_grabacion','id');
    }
}
