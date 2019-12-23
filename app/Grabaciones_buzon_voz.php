<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Grabaciones_buzon_voz extends Model
{
    protected $primaryKey = 'uniqueid';
    public $timestamps = false;

    protected $fillable = [
        'uniqueid', 'fecha_inicio','fecha_fin','callerid', 'nombre_archivo', 'estado', 'resquest', 'response', 'Empresas_id',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Grabaciones_buzon_voz';
     /**
     * Funcion para obtener solo los registros de una empresa
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('Empresas_id', $empresa);
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
     * Relacion muchos a uno con CDR call center detalles
     */
    public function Cdr_call_center_detalles()
    {
        return $this->belongsTo('Nimbus\Cdr_call_center_detalles', 'uniqueid', 'uniqueid');
    }
}
