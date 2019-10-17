<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre', 'tipo_marcacion','Campanas_id','Formularios_id'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Calificaciones';
    /**
     * Función para obtener solo los registros activos
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
     * Relacion muchos a muchos con Grupos
     */
    public function Grupos()
    {
        return $this->belongsToMany('Nimbus\Grupos', 'Grupo_Calificaciones');
    }
    /**
     * Relacion uno a muchos con Sub_Calificaciones
     */
    public function Sub_Calificaciones()
    {
        return $this->hasMany('Nimbus\Sub_Calificaciones');
    }
    /**
     * Relacion uno a uno con Formularios
     */
    public function Formularios()
    {
        return $this->hasOne('Nimbus\Formularios', 'id', 'Formularios_id');
    }
}
