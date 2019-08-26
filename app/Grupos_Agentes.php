<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grupos_Agentes extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'Agente_id','Grupos_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Grupos_Agentes';
    /**
     * Muchos a uno con Agentes
     */
    public function Agentes()
    {
        return $this->belongsTo('Nimbus\Agentes', 'Agentes_id', 'id');
    }
}
