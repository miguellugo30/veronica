<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Distribuidor extends Model
{

     public $timestamps = false;

   protected $fillable = [
        'servicio', 'distribuidor', 'numero_soporte', 'img_header','img_pie'
    ];
     protected $table = 'Cat_Distribuidor';

    /**
     * Relacion uno a muchos con Troncales
     */
    public function Troncales()
    {
        return $this->hasMany('Nimbus\Troncales');
    }
    /**
     * Relacion uno a muchos con Canales
     */
    public function Canales()
    {
        return $this->hasMany('Nimbus\Canales');
    }
}
