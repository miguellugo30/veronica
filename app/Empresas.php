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
     * Relacion uno a muchos con Did
     */
    public function Canales()
    {
        return $this->hasMany('Nimbus\Canales');
    }
    /**
     * Relacion uno a uno con Config Empresas
     */
    public function Config_Empresas()
    {
        return $this->hasOne('Nimbus\Config_Empresas', 'Empresas_id', 'id');
    }

}
