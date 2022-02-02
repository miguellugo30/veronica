<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campanas extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'modalidad_logue',
        'modalidad_grabacion',
        'opciones_desvio',
        'id_opciones_desvio',
        'buzon','speech_id',
        'id_grabacion',
        'time_max_sonora',
        'time_max_llamada',
        'time_liberacion',
        'id_relacion',
        'tipo_marcacion',
        'Base_Datos_id',
        'Empresas_id',
        'Grupos_id',
        'fk_calificaciones_id',
        'no_intentos',
        'modalidad_marcado'
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
    /**
     * Funcion para obtener solo los registros de una empresa
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('Empresas_id', $empresa);
    }

    public function scopeTipo($query, $tipo_marcacion)
    {
        return $query->where('tipo_marcacion', $tipo_marcacion);
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
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
     * Relacion uno a uno con Base_Datos
     */
    public function Base_Datos()
    {
        return $this->hasOne('App\Bases_datos', 'id', 'Base_Datos_id');
    }
    /**
     * Relacion uno a uno con Formularios
     */
    public function Formularios()
    {
        return $this->hasOne('App\Formularios', 'id', 'Formularios_id');
    }
    /**
     * Relacion uno a muchos con Calificaciones
     */
    public function Grupos()
    {
        return $this->hasMany('App\Grupos', 'id', 'Grupos_id');
    }
    /**
     * Relacion uno a uno con Campanas_Configuracion
     */
    public function Campanas_Configuracion()
    {
        return $this->hasOne('App\Campanas_Configuracion', 'Campanas_id','id');
    }
    /**
     * Uno a muchos con Agentes
     */
    public function Miembros_Campana()
    {
        return $this->belongsTo('App\Miembros_Campana');
    }
    /**
     * Relacion uno a uno con Speech
     */
    public function Speech()
    {
        return $this->hasOne('App\Speech', 'id','speech_id');
    }
    /**
     * Relacion uno a muchos con DID
     */
    public function Did()
    {
        return $this->belongsToMany('App\Dids', 'Campanas_did', 'fk_campanas', 'fk_dids');
    }
        /**
     * Relacion muchos a uno Campanas
     */
    public function Estado_Campanas()
    {
        return $this->belongsToMany('App\Cat_estado_campanas', 'Campanas_activas', 'fk_campanas', 'fk_cat_estado_campanas')->where('activo',  1);
    }
}
