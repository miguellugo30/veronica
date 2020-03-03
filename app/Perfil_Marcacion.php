<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Perfil_Marcacion extends Model
{
  /*
   * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
   */
   public $timestamps = false;
   /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'fk_prefijos_marcacion_id', 'fk_perfiles_id' , 'fk_canales_id', 'fk_dids_id', 'activo',
     ];
   /**
    * Nombre de la tabla
    */
    protected $table = 'Perfil_marcacion';
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
    * Relacion muchos a uno con Prefijos_marcacion
    */
    public function PrefijosMarcacion()
    {
       return $this->belongsTo('Nimbus\PrefijosMarcacion', 'fk_prefijos_marcacion_id');
    }
   /**
    * Relacion muchos a uno con Perfiles
    */
    public function Perfiles()
    {
       return $this->belongsTo('Nimbus\Perfiles', 'fk_perfiles_id');
    }
   /**
    * Relacion muchos a uno con Canales
    */
    public function Canales()
    {
       return $this->belongsTo('Nimbus\Canales','fk_canales_id', 'Cat_Canales_Tipo_id');
    }
   /**
    * Relacion muchos a uno con Dids
    */
    public function Dids()
    {
       return $this->belongsTo('Nimbus\Dids', 'fk_dids_id');
    }
}
