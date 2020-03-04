<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class DatosFormularios extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uniqueid', 'Calificaciones_id', 'Formularios_id', 'Campos_id', 'valor', 'fk_campanas_id', 'fecha_registro_llamada'
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Datos_Formularios';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Uno a muchos con Empresas
     */
    public function CDR()
    {
        return $this->belongsTo('Nimbus\Crd_Call_Center', 'uniqueid', 'uniqueid');
    }
}
