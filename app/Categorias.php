<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'tipo',
    ];

    /**
     * Relacion uno a muchos con sub categoria
     */
    public function Sub_Categorias()
    {
        return $this->hasMany('Nimbus\Sub_Categorias', 'id_categoria')->orderBy('prioridad');;
    }
}
