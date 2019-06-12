<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Distribuidor extends Model
{
   protected $fillable = [
        'servicio', 'distribuidor', 'numero_soporte', 'img_header','img_pie'
    ];
     protected $table = 'Cat_Distribuidor';
}
