<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Ivr_Opciones extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tipo', 'digito','tabla','tabla_id','Ivr_id',
    ];
    /**
     * Nombre de la tabla que se ocupara
     */
    protected $table = 'Opciones_Ivr';
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
    public function Ivr()
    {
        return $this->belongsTo('Nimbus\Ivr_Opciones', 'Ivr_id', 'id');
    }
}
