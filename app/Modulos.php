<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'modulos';
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
     * Relacion muchos a muchos con Empresas
     */
    public function Empresas()
    {
        return $this->belongsToMany('App\Empresas', 'Modulos_Empresas');
    }
    /**
     * Relacion uno a muchos con Modulos
     */
    public function Categorias()
    {
        return $this->hasMany('App\Categorias')->where('activo',  1);
    }
}
