<?php

namespace Nimbus;

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

    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id','id');
    }
    /**
     * Relacion muchos a uno con Tipo_Marcacion
     */
    public function Tipo_Marcacion()
    {
        return $this->belongsTo('Nimbus\Cat_Tipo_Marcacion', 'Cat_Tipo_Marcacion_id','id');
    }
    /**
     * Relacion uno a muchos con Formularios_campos
     */
    public function Formularios_Campos()
    {
        return $this->belongsToMany('Nimbus\Campos', 'Formularios_Campos');
    }
    /**
     * Relacion uno a muchos con Sub_Formularios
     */
    public function Sub_Formularios()
    {
        return $this->hasMany('Nimbus\Sub_Formularios');
    }

    /**
    ## Relacion uno a uno con Calificaciones
    */
    public function Calificaciones()
    {
        return $this->hasOne('Nimbus\Calificaciones', 'id', 'Formularios_id');
    }   
    

}

