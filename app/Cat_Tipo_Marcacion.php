<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat_Tipo_Marcacion extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'tipo'
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cat_Tipo_Marcacion';

     /**
     * Relacion uno a muchos con Formularios
     */
    public function Formularios()
    {
        return $this->hasMany('App\Formularios');
    }
    
    /** Relacion uno a muchos con Calificaciones */
    public function Calificaciones()
    {
        return $this->hasMany('App\Calificaciones');
    }
}
