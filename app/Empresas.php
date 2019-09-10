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
        'nombre', 'contacto_cliente', 'direccion', 'ciudad', 'estado', 'pais', 'telefono', 'movil', 'correo', 'fecha_creacion',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Empresas';
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
    /**
     * Relacion muchos a muchos con Modulos
     */
    public function Modulos()
    {
        return $this->belongsToMany('Nimbus\Modulos', 'Modulos_Empresas')->orderBy('prioridad');
    }
    /**
     * Relacion uno a uno con Cat_Estado_Empresas
     */
    public function Cat_Estado_Empresa()
    {
        return $this->hasOne('Nimbus\Cat_Estado_Empresa', 'id', 'Cat_Estado_Empresa_id');
    }
     /**
     * Relacion uno a muchos con Cat_Extensiones
     */
    public function Cat_Extensiones()
    {
        return $this->hasMany('Nimbus\Cat_Extensiones');
    }
    /**
     * Relacion uno a muchos con Sub_Formularios
     */
    public function Formularios()
    {
        return $this->hasMany('Nimbus\Formularios');
    }
    /**
     * Relacion uno a muchos con Sub_Formularios
     */
    public function Speech()
    {
        return $this->hasMany('Nimbus\speech');
    }
}
