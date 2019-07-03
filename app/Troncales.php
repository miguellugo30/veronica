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
        'nombre', 'ip', 'Cat_Distribuidor_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Troncales';
    /**
     * Relación muchos a muchos con empresas
     */
    public function Cat_Distribuidor()
    {
        return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
    /**
     * Relacion uno a muchos con Canales
     */
    public function Canales()
    {
        return $this->hasMany('Nimbus\Canales');
    }
}
