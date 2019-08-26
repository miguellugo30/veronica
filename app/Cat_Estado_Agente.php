<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Estado_Agente extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion', 'recibir_llamada','activo',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Estado_Agente';

    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
     * Relacion uno a uno con Cat_Estdo_Agente
     */
    public function Agentes()
    {
        return $this->hasOne('Nimbus\Agentes', 'Cat_Estdo_Agente_id', 'id');
    }
}
