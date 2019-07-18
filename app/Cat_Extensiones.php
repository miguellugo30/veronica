<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Extensiones extends Model
{
     /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'extension', 'Empresas_id', 'Canales_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Cat_Extensiones';
    /**
     * Relacion uno a uno con Cat_Estado_Empresas
     */
    public function Canales()
    {
        return $this->hasOne('Nimbus\Canales');
    }
    /**
     * Relacion muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id');
    }
}
