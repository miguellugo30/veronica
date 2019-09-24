<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
     //
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'tipo_marcacion','Campanas_id','Formularios_id'
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

    /**
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
    ## Relacion muchos a uno con Grupo_Calificaciones
    -- Relacion con Campanas
     */
    public function Grupo_Calificaciones()
    {
        return $this->belongsTo('Nimbus\Grupo_Calificaciones', 'Grupo_Calificaciones','id');
    }
    
    ###-----CONFIRMAR--------
    /**
     * 
    ## Relacion muchos a uno con Tipo_Marcacion
    */
    #public function Tipo_Marcacion()
    #{
    #    return $this->belongsTo('Nimbus\Cat_Tipo_Marcacion', 'Cat_Tipo_Marcacion_id','id');
    #}
    
   
    /**
    ## Relacion uno a uno con Formularios
     */
    public function Formularios()
    {
        return $this->hasOne('Nimbus\Formularios', 'id', 'Formularios_id');
    }   
    
        
    /**
    ## Relacion uno a muchos con Sub_Calificaciones
    */
    public function Sub_Calificaciones()
    {
        return $this->hasMany('Nimbus\Sub_Calificaciones');
    }


}
