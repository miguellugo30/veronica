<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenciasBria extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'licencia', 'ocupadas', 'disponibles',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Licencias_Bria';
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
    */
    /**
     * Relacion uno a muchos con Cat_Extensiones
     */
    public function Extensiones()
    {
        return $this->hasMany('App\Cat_Extensiones', "Cat_Licencias_Bria_id");
    }
}
