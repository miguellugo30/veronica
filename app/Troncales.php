<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Troncales extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre', 'troncal_sansay',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Troncales';
     /**
     * Relación uno a muchos con Troncales
     */
    public function Dids()
    {
        return $this->hasMany('Nimbus\Dids', 'Troncales_id');
    }
    /**
     * Relación muchos a muchos con empresas
     */
    public function Empresas()
    {
        return $this->belongsToMany('Nimbus\Empresas', 'Troncales_Empresas');
    }
}
