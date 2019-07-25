<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Cat_Distribuidor extends Model
{

     public $timestamps = false;

   protected $fillable = [
        'servicio', 'distribuidor','numero_soporte','prefijo','img_header','img_pie'
    ];

    protected $table = 'Cat_Distribuidor';
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
    /**
     * Relacion uno a muchos con Troncales
     */
    public function Troncales()
    {
        return $this->hasMany('Nimbus\Troncales', 'Cat_Distribuidor_id');
    }
    /**
     * Relacion uno a muchos con Canales
     */
    public function Canales()
    {
        return $this->hasMany('Nimbus\Canales');
    }
    /**
     * Relacion uno a muchos con Config Empresas
     * PARAMETROS
     * 1 Tabla Empresas
     * 2 Tabla Config_Empresas
     * 3 Llave foranea de Config_Empresas
     * 4 Llave Primaria Empresas
     * 5 Llave Local de Cat_Distribuidores
     * 6 Llave Foranea de Config_Empresas
     */
    public function Config_Empresas()
    {
        return $this->hasManyThrough( 'Nimbus\Empresas', 'Nimbus\Config_Empresas', 'Cat_Distribuidor_id', 'id', 'id', 'Empresas_id' );
    }
    /**
     * Relacion uno a muchos con Tipo_Canales
     */
    public function Cat_Tipo_Canales()
    {
        return $this->hasMany('Nimbus\Cat_Tipo_Canales','id','Cat_Distribuidor_id');
    }
}
