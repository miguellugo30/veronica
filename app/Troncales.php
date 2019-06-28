<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Troncales extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre', 'troncal_sansay',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Troncales';
}
