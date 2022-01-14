<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros_Eventos_Agentes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fecha_inicio', 'fecha_fin', 'cierre_correcto', 'Eventos_Agentes_id','Agentes_id',
    ];
    /**
     * Nombre de la tabla que se ocupara
     */
    protected $table = 'Registros_Eventos_Agentes';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Empresas
     */
    public function Eventos_agentes()
    {
        return $this->belongsTo('App\Eventos_Agentes', 'Eventos_Agentes_id', 'id');
    }
    /**
     * Muchos a uno con Empresas
     */
    public function Agentes()
    {
        return $this->belongsTo('App\Agentes', 'Agentes_id', 'id');
    }
}
