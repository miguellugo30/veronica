<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nivel', 'accion', 'tabla', 'id_registro', 'mensaje', 'users_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Logs';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion muchos a uno con Users
     */
    public function Usuarios()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
