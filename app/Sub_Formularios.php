<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Sub_Formularios extends Model
{
    /**
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'opcion', 'texto', 'Formularios_id', 'Campos_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Sub_Formulario';
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
    */
    /**
     * Relacion muchos a uno con Cat_Distribuidor
     */
    public function Formularios()
    {
        return $this->belongsTo('Nimbus\Formularios', 'Formularios_id', 'id');
    }
    /**
     * Relacion muchos a uno con Cat_Distribuidor
     */
    public function Campos()
    {
        return $this->belongsTo('Nimbus\Campos', 'Campos_id', 'id');
    }
}
