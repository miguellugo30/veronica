<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Miembros_Campana extends Model
{
    /**
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'membername', 'queue_name', 'interface', 'penality', 'paused','Agentes_id','Campanas_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Miembros_Campanas';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }

    protected $casts = [
        'Agentes_id' => 'integer',
      ];
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Muchos a uno con Campana
     */
    public function Campanas()
    {
        return $this->belongsTo('Nimbus\Campanas', 'Campanas_id', 'id');
    }
    /**
     * Muchos a uno con Agentes
     */
    public function Agentes()
    {
        return $this->belongsTo('Nimbus\Agentes', 'Agentes_id', 'id');
    }
}
