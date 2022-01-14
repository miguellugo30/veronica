<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat_Extensiones extends Model
{
     /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'extension', 'Empresas_id', 'Canales_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Extensiones';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeEmpresa($query, $empresa_id)
    {
        return $query->where('Empresas_id', $empresa_id);
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion uno a uno con Cat_Estado_Empresas
     */
    public function Canales()
    {
        return $this->hasOne('App\Canales', 'id', 'Canales_id');
    }
    /**
     * Relacion muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('App\Empresas', 'Empresas_id');
    }
    /**
     * Relacion muchos a uno con Cat_Licencias_Bria
     */
    public function Licencias()
    {
        return $this->belongsTo('App\LicenciasBria', 'Cat_Licencias_Bria_id');
    }
}
