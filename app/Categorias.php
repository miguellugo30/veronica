<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    /**
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'descripcion', 'class_icon', 'tipo',
    ];
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
    /**
     * Relacion uno a muchos con sub categoria
     */
    public function Sub_Categorias()
    {
        return $this->hasMany('Nimbus\Sub_Categorias', 'id_categoria')->where('activo',  1)->orderBy('prioridad');
    }
}
