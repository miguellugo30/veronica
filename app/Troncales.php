<?php

namespace App;

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
        'nombre', 'descripcion' , 'Cat_Distribuidor_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Troncales';
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
    public function Cat_Distribuidor()
    {
        return $this->belongsTo('App\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
    /**
     * Relacion uno a muchos con Canales
     */
    public function Canales()
    {
        return $this->hasMany('App\Canales');
    }
    /**
     * Relación muchos a muchos con empresas
     */
    public function Troncales_Sansay()
    {
        return $this->hasOne('App\Troncales_Sansay', 'Troncales_id', 'id');
    }
}
