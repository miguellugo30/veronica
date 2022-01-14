<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Did_Enrutamiento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'aplicacion', 'prioridad','tabla','tabla_id','Dids_id','activo',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Did_Enrutamiento';
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
    /**
    * Relacion uno a uno con Caneles
    */
    public function Did()
    {
        return $this->hasOne('App\Dids', 'id', 'Dids_id');
    }

}
