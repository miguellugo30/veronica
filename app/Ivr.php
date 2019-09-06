<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Ivr extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'mensaje_bienvenida_id','tiempo_espera','mensaje_tiempo_espera_id','mensaje_opcion_invalida_id','repeticiones','activo','Empresas_id',
    ];
    /**
     * Nombre de la tabla que se ocupara
     */
    protected $table = 'Ivr';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
    * Relación muchos a uno con Empresas
    */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
    /**
    * Relación muchos a uno con Empresas
    */
    public function Ivr_Opciones()
    {
        return $this->hasMany('Nimbus\Ivr_Opciones');
    }

}
