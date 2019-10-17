<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Token_Soporte extends Model
{
    /**
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'token', 'caducidad', 'users_id', 'Empresas_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Token_Soporte';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relación muchos a uno con Cat_Distribuidor
     */
    public function Users()
    {
        return $this->belongsTo('Nimbus\User', 'users_id', 'id');
    }
    /**
     * Relación muchos a uno con Cat_Distribuidor
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
}
