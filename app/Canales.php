<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Canales extends Model
{
    /*
    * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
    */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
       'canal', 'tipo' , 'Troncales_id', 'Empresas_id', 'Cat_Distribuidor_id',
    ];
    /**
     * Nombre de la tabla
     */
   protected $table = 'Canales';
   /**
     * Relacion uno a muchos con Did
     */
    public function Dids()
    {
        return $this->hasMany('Nimbus\Dids');
    }
    /**
    * Relacion muchos a uno con Troncales
    */
    public function Troncales()
    {
       return $this->belongsTo('Nimbus\Troncales', 'Troncales_id');
    }
    /**
    * Relacion muchos a uno con Distribuidores
    */
    public function Distribuidores()
    {
       return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
    /**
    * Relacion muchos a uno con Distribuidores
    */
    public function Empresas()
    {
       return $this->belongsTo('Nimbus\Empresas', 'Empresas_id');
    }
     /**
    * Relacion uno a uno con Cat_Tipo_Canales
    */
    public function Cat_Tipo_Canales()
    {
        return $this->hasOne('Nimbus\Cat_Tipo_Canales', 'id','Cat_Tipo_Canales_id');
    }
}
