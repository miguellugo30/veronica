<?php


namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grupo_Calificaciones extends Model
{      
    /** Esto sirve para insertar la fecha tipo timestamp debido a la configuracion de Laravel  */
    public $timestamps = false;

    protected $fillable = [
        'Calificaciones_id','Grupos_id'
    ];
    /** Tabla a relacionar   **/
    protected $table = 'Grupo_Calificaciones';

   /** Relacion uno a muchos con Calificaciones  **/
    public function Calificaciones()
    {
        return $this->hasMany('Nimbus\Calificaciones');
    }
    
    //
}
