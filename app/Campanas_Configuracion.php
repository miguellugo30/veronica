<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Campanas_Configuracion extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'name', 'musiconhold','anunce','timeout','periodic_announce','periodic_announce_frequency','wrapuptime','penaltymemberslimit','strategy','joinempty','leavewhenempty','memberdelay','Campanas_id'
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Campanas_Configuracion';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     *      * Relacion uno a uno con Campanas
     */
    public function Campanas()
    {
        return $this->hasOne('Nimbus\Campanas', 'Campanas_id', 'id');
    }
    /**
    * Relacion uno a uno con Adios_Empresas
    */
    public function Audios_Empresa()
    {
        return $this->hasOne('Nimbus\Audios_Empresa','ruta','periodic_announce');
    }


}
