<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion','tipo','Empresas_id','id'
    ];
    /**
     * Nombre de la tabla que se ocupara
     */
    protected $table = 'speech';
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
     * Muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
    /**
     * Relacion uno a muchos con Speech
     */
    public function Opciones_Speech()
    {
        return $this->hasMany('Nimbus\Opciones_Speech', 'speech_id');
        //return $this->belongsTo('Nimbus\Opciones_Speech');
    }
}
