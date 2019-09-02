<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
   /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre','descripcion','activo', 'tipo_grupo', 'Empresas_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Grupos';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
     * Relacion muchos a muchos con Grupos_Agentes
     */
    public function Agentes()
    {
        return $this->belongsToMany('Nimbus\Agentes', 'Grupos_Agentes');
    }
}