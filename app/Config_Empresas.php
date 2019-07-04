<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Config_Empresas extends Model
{
   /*
   * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
   */
   public $timestamps = false;
   /**
    * Campos que pueden ser modificados
    */
  protected $fillable = [

   ];
   /**
    * Nombre de la tabla
    */
    protected $table = 'Config_Empresas';
    /**
    * Relacion uno a uno con Empresas
    */
    public function Empresas()
    {
        return $this->hasOne('Nimbus\Empresas', 'Empresas_id');
    }
    /**
    * Relacion uno a uno con Cat_Distribuidor
    */
    public function Cat_Distribuidor()
    {
        return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
}
