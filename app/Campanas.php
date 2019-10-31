<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Campanas extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
<<<<<<< HEAD
        'nombre', 'modalidad_logue','modalidad_grabacion','opciones_desvio','id_opciones_desvio','buzon','speech_id','id_grabacion','time_max_sonora','time_max_llamada','time_liberacion','id_relacion','tipo_marcacion','Base_Datos_id','Empresas_id','Grupos_id'
=======
        'nombre', 'modalidad_logue','modalidad_grabacion','opciones_desvio','id_opciones_desvio','buzon','speech_id','id_grabacion','time_max_sonora','time_max_llamada','time_liberacion','id_relacion','tipo_marcacion','Base_Datos_id','Empresas_id','Formularios_id'
>>>>>>> e02dcd1798106ff862120d98e2a38acdd47d1fe3
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
     * Relacion uno a muchos con Calificaciones
     */
    public function Grupos()
    {
        return $this->hasMany('Nimbus\Grupos', 'id', 'Grupos_id');
    }
    /**
     * Relacion uno a uno con Campanas_Configuracion
     */
    public function Campanas_Configuracion()
    {
        return $this->hasOne('Nimbus\Campanas_Configuracion', 'Campanas_id','id');
    }
    /**
     * Uno a muchos con Agentes
     */
    public function Miembros_Campana()
    {
        return $this->belongsTo('Nimbus\Miembros_Campana');
    }
    /**
     * Relacion uno a uno con Speech
     */
    public function Speech()
    {
        return $this->hasOne('Nimbus\Speech', 'id','speech_id');
    }
}
