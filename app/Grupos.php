<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'id','nombre','descripcion','activo', 'tipo_grupo', 'Empresas_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Grupos';
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
     * Relacion muchos a muchos con Grupos_Agentes
     */
    public function Agentes()
    {
        return $this->belongsToMany('Nimbus\Agentes', 'Grupos_Agentes');
    }
    /**
     * Relacion muchos a muchos con Condiciones de tiempo
     */
    public function Condiciones_Tiempo()
    {
        return $this->hasMany('Nimbus\Condiciones_Tiempo');
    }
    /**
     * Relacion muchos a muchos con Grupos_Agentes
     */
    public function Calificaciones()
    {
        return $this->belongsToMany('Nimbus\Calificaciones', 'Grupo_Calificaciones');
    }
}
