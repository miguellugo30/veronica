<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grabaciones extends Model
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
