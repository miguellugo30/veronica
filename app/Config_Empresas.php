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
     * Declaramos el campo que se usara como
     * llave primaria, servira para realizar busquedas en
     * base al id de empresa
     */
    protected  $primaryKey  = 'Empresas_id';
    /**
    * Relacion uno a uno con Empresas
    */
    public function Empresas()
    {
        return $this->hasOne('Nimbus\Empresas', 'id');
    }
    /**
    * Relacion muchos a uno con Cat_Distribuidor
    */
    public function Distribuidores()
    {
        return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id', 'id');
    }
    /**
     * Relacion uno a uno con Base de Datos
     */
    public function BaseDatos()
    {
        return $this->belongsTo('Nimbus\BaseDatos', 'Cat_Base_Datos_id');
    }
    /**
     * Relacion uno a uno con IP PBX
     */
    public function ms()
    {
        return $this->belongsTo('Nimbus\Cat_IP_PBX', 'Cat_IP_PBX_id');
    }
    /**
     * Relacion uno a uno con Dominio
     */
    public function Dominio()
    {
        return $this->belongsTo('Nimbus\Dominios', 'Dominios_id');
    }
}
