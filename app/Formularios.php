<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formularios extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'Cat_Tipo_Marcacion_id','Empresas_id'
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Formularios';
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
        return $this->belongsTo('App\Empresas', 'Empresas_id','id');
    }
    /**
     * Relacion muchos a uno con Tipo_Marcacion
     */
    public function Tipo_Marcacion()
    {
        return $this->belongsTo('App\Cat_Tipo_Marcacion', 'Cat_Tipo_Marcacion_id','id');
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion uno a muchos con Formularios_campos
     */
    public function Formularios_Campos()
    {
        return $this->belongsToMany('App\Campos', 'Formularios_Campos');
    }
    /**
     * Relacion uno a muchos con Sub_Formularios
     */
    public function Sub_Formularios()
    {
        return $this->hasMany('App\Sub_Formularios');
    }

    /**
     * Relacion uno a uno con Calificaciones
     */
    public function Calificaciones()
    {
        return $this->hasOne('App\Calificaciones', 'id', 'Formularios_id');
    }


}

