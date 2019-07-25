<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Troncales extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre', 'descripcion', 'ip_host' , 'Cat_Distribuidor_id', 'Cat_IP_PBX_id',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Troncales';
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
     * Relación muchos a muchos con empresas
     */
    public function Cat_Distribuidor()
    {
        return $this->belongsTo('Nimbus\Cat_Distribuidor', 'Cat_Distribuidor_id');
    }
    /**
     * Relacion uno a muchos con Canales
     */
    public function Canales()
    {
        return $this->hasMany('Nimbus\Canales');
    }
    /**
     * Relación muchos a muchos con empresas
     */
    public function PBX()
    {
        return $this->belongsTo('Nimbus\Cat_IP_PBX', 'Cat_IP_PBX_id');
    }
}
