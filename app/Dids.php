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
        'prefijo', 'did', 'numero_real' , 'referencia','gateway','fakedid', 'Empresas_id','Canales_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Dids';
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

?>
