<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Condiciones_Tiempo extends Model
{
    /*
   * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
   */
   public $timestamps = false;
   /**
    * Campos que pueden ser modificados
    */
  protected $fillable = [
       'nombre', 'hora_inicio', 'hora_fin' , 'dia_semana_inicio','dia_semana_fin','dia_mes_inicio', 'dia_mes_fin','mes_inicio','mes_fin','tabla_verdadero','tabla_verdadero_id','tabla_falso','tabla_falso_id','Grupos_id',
   ];
   /**
    * Nombre de la tabla
    */
   protected $table = 'Condiciones_Tiempo';
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
     * Muchos a uno con Grupos
     */
    public function Grupos()
    {
        return $this->belongsTo('Nimbus\Grupos', 'Grupos_id', 'id');
    }

}
