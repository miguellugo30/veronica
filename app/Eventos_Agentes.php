<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Eventos_Agentes extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre', 'tiempo', 'Empresas_id'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Eventos_Agentes';
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
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Uno a muchos con Registros_Eventos_Agentes
     */
    public function Registros_Eventos_Agentes()
    {
        return $this->hasMany('Nimbus\Registro_Eventos_Agentes');
    }
    /**
     * Muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
}
