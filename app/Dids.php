<?php
//MODELO DE DID
namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Dids extends Model
{
   /*
   * Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel
   */
   public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
   protected $fillable = [
        'tipo', 'prefijo', 'did', 'descripcion','gateway','fakedid', 'Troncales_id', 'Empresas_id'
    ];
    /**
     * Nombre de la tabla
     */
   protected $table = 'Dids';
   /**
    * Relacion muchos a uno con Empresas
    */
    public function Empresas()
    {
       return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
     /**
    * Relacion muchos a uno con Canales
    */
    public function Canales()
    {
       return $this->belongsTo('Nimbus\Canales', 'Canales_id', 'id');
    }
}
