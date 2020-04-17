<?php

namespace Nimbus;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agentes extends  Authenticatable
{
    use Notifiable;
    /*
     * Esto sirve para insertar la fecha tipo timestamp debido a la configuración de Laravel
     */
    public $timestamps = false;
    /**
     * Campos que se usaran en el proceso de la vista
     */
    protected $fillable = [
        'id', 'nombre', 'usuario', 'email', 'password', 'contrasena' , 'extension', 'nivel', 'extension_real','pin','mix_monitor','id_perfil_marcacion','calificar_llamada','tipo_licencia','envio_sms','id_direccion','editar_datos', 'monitoreo','Cat_Estado_Agente_id','Empresas_id','Canales_id',
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
    /**
     * Funcion para obtener solo los registros de una empresa
     */
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('Empresas_id', (int)$empresa);
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
    public function Grupos()
    {
        return $this->belongsToMany('Nimbus\Grupos', 'Grupos_Agentes');
    }
    /**
     * Relacion uno a uno con Cat_Estdo_Agente
     */
    public function Cat_Estado_Agente()
    {
        return $this->hasOne('Nimbus\Cat_Estado_Agente', 'id', 'Cat_Estado_Agente_id');
    }
    /**
     * Uno a muchos con Agentes
     */
    public function Miembros_Campana()
    {
        return $this->belongsTo('Nimbus\Miembros_Campana', 'id', 'Agentes_id');
    }
    /**
     * Uno a muchos con Grupos_Agentes
     */
    public function Canales()
    {
        return $this->belongsTo('Nimbus\Canales', 'Canales_id', 'id');
    }
    /**
     * Uno a muchos con Asignacion Agente
     */
    public function Crd_Asignacion_Agente()
    {
        return $this->hasMany('Nimbus\Crd_Asignacion_Agente');
    }
    /**
     * Uno a muchos con Registros_Eventos_Agentes
     */
    public function Registros_Eventos_Agentes()
    {
        return $this->hasMany('Nimbus\Registros_Eventos_Agentes', 'Agentes_id', 'id');
    }
    /**
     * Uno a uno con Perfiles
     */
    public function Perfiles()
    {
        return $this->hasMany('Nimbus\Perfiles', 'id', 'id_perfil_marcacion');
    }
    /**
     * Uno a muchos con Historial de eventos
     */
    public function Historial_Eventos()
    {
        return $this->hasMany('Nimbus\HistorialEventosAgentes', 'fk_agentes_id', 'id');
    }

}
