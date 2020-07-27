<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Troncales_Sansay extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'name', 'type', 'host' , 'context', 'dtmfmode', 'directmedia', 'canreinvite', 'disallow', 'allow', 'qualify', 'Troncales_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Troncales_Sansay';
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
     * Relación muchos a muchos con empresas
     */
    public function Troncales()
    {
        return $this->belongsTo('App\Troncales', 'Troncales_id');
    }
}
