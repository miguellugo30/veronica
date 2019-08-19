<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
     //
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'Cat_Tipo_Marcacion_id','Campanas_id','Formularios_id'
    ];
    #Tabla Activa
    protected $table = 'Calificaciones';
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
     * Relacion muchos a uno con Empresas
     */
    public function Campanas()
    {
        return $this->belongsTo('Nimbus\Campanas', 'Campanas_id','id');
    }
    /**
     * Relacion muchos a uno con Tipo_Marcacion
     */
    public function Tipo_Marcacion()
    {
        return $this->belongsTo('Nimbus\Cat_Tipo_Marcacion', 'Cat_Tipo_Marcacion_id','id');
    }
    /**
     * Relacion uno a muchos con Formularios
     */
    public function Formularios()
    {
        return $this->belongsToMany('Nimbus\Formularios', 'Formularios');
    }
    /**
     * Relacion uno a muchos con Sub_Calificaciones
     */
    public function Sub_Calificaciones()
    {
        return $this->hasMany('Nimbus\Sub_Calificaciones');
    }


}
