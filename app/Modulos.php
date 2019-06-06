<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $fillable = [
        'nombre', 'descripcion',
    ];
}
