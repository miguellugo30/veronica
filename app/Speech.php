<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'tipo','nombre', 'descripcion', 'texto', 'Empresas_id',
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
     * Muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('App\Empresas', 'Empresas_id', 'id');
    }
    /**
     * Relacion uno a muchos con Speech
     */
    public function Opciones_Speech()
    {
        return $this->hasMany('App\Opciones_Speech', 'speech_id');
    }
}
