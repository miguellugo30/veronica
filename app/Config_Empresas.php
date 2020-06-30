<?php

namespace App;

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
        'usuario_ami', 'clave_ami', 'zona_horaria', 'horario_verano', 'fecha_vencimiento', 'agentes_entrada', 'agentes_salida', 'agentes_dual', 'canal_mensajes_voz', 'canal_generador_encuestas', 'licencias_ivr_inteligente', 'licencias_administrador', 'licencias_softphone', 'almacenamiento_posiciones', 'almacenamiento_adicional', 'clave_aprov', 'https', 'Empresas_id', 'Dominios_id', 'Cat_IP_PBX_id', 'Cat_Base_Datos_id', 'Cat_Distribuidor_id',
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
        return $this->hasOne('App\Empresas', 'id');
    }
    /**
    * Relacion muchos a uno con Cat_Distribuidor
    */
    public function Distribuidores()
    {
        return $this->belongsTo('App\Cat_Distribuidor', 'Cat_Distribuidor_id', 'id');
    }
    /**
     * Relacion uno a uno con Base de Datos
     */
    public function BaseDatos()
    {
        return $this->belongsTo('App\BaseDatos', 'Cat_Base_Datos_id');
    }
    /**
     * Relacion uno a uno con IP PBX
     */
    public function ms()
    {
        return $this->belongsTo('App\Cat_IP_PBX', 'Cat_IP_PBX_id');
    }
    /**
     * Relacion uno a uno con Dominio
     */
    public function Dominio()
    {
        return $this->belongsTo('App\Dominios', 'Dominios_id');
    }
}
