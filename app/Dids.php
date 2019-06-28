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

   //Campos que se usaran en el proceso de la vista
   protected $fillable = [
        'id_empresa','tipo', 'prefijo', 'did', 'descripcion','id_troncal_sansay','gateway','fakedid'
    ];
   protected $table = 'Dids';
}
