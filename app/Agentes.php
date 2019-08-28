<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Agentes extends Model
{
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'nombre', 'ususario', 'contrasena' , 'extension', 'extension_real','pin','mix_monitor','id_perfil_marcacion','calificar_lladada','tipo_licencia','envio_sms','id_direccion','editar_datos','activo','Cat_Estado_Agente_id','Empresa',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Agentes';
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
     * Muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id', 'id');
    }
    /**
     * Uno a muchos con Grupos_Agentes
     */
    public function Grupos_Agentes()
    {
        return $this->belongsTo('Nimbus\Grupos_Agentes', 'Grupos_Agentes');
    }
    /**
     * Relacion uno a uno con Cat_Estdo_Agente
     */
    public function Cat_Estdo_Agente()
    {
        return $this->hasOne('Nimbus\Cat_Estdo_Agente', 'Cat_Estdo_Agente_id', 'id');
    }
    /**
     * Uno a muchos con Agentes
     */
    public function Miembros_Campana()
    {
        return $this->belongsTo('Nimbus\Miembros_Campana');
    }

}
