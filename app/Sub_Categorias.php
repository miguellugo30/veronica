<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Categorias extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'tipo', 'id_categoria','permiso'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'sub_categorias';
}
