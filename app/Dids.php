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
     /**
     * Funcion para obtener solo los registros de una empresa
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('Empresas_id', $empresa);
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
   /**
   * Relacion uno a uno con Did_Entrutamiento
   */
   public function Did_Enrutamiento()
   {
      return $this->hasOne('Nimbus\Did_Enrutamiento', 'Dids_id', 'id')->orderby('prioridad');
   }
   /**
    * Relacion uno a muchos con Perfil_marcacion
    */
   public function Perfil_marcacion()
   {
       return $this->hasMany('Nimbus\Perfil_marcacion');
   }
}

?>
