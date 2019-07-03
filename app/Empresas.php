<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'contacto_cliente', 'direccion', 'ciudad', 'pais', 'telefono', 'movil', 'correo', 'fecha_creacion',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Empresas';
    /**
     * Relacion uno a muchos con Did
     */
    public function Dids()
    {
        return $this->hasMany('Nimbus\Dids');
    }
    /**
     * Relacion muchos a muchos con Troncales
     */
    public function Troncales()
    {
        return $this->belongsToMany('Nimbus\Troncales', 'Troncales_Empresas');
    }
}
