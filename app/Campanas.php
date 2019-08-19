<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Campanas extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'modalidad_logueo','modalidad_grabacion','opciones_desvio','id_opciones_desvio','buzon','id_speech','id_grabacion','time_max_sonora','time_max_llamada','time_liberaion','id_relacion','tipo_marcacion','Base_Datos_id','Empresas_id','Formularios_id'
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Campanas';
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
     * Relacion uno a uno con Base_Datos
     */
    public function Base_Datos()
    {
        return $this->hasOne('Nimbus\Base_Datos', 'id', 'Base_Datos_id');
    }
    /**
     * Relacion uno a uno con Formularios
     */
    public function Formularios()
    {
        return $this->hasOne('Nimbus\Formularios', 'id', 'Formularios_id');
    }
    
    
    /**
    ## Relacion uno a muchos con Calificaciones
    */
    public function Calificaciones()
    {
        return $this->hasMany('Nimbus\Calificaciones');
    }
    
    
    
}
