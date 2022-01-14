<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    /**
     * Deshabilitamos los timestamps en la tablas
     */
    public $timestamps = false;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'contacto_cliente', 'direccion', 'ciudad', 'estado', 'pais', 'telefono', 'movil', 'correo', 'fecha_creacion',
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'Empresas';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeEmpresa($query, $id)
    {
        return $query->where('id', $id);
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion uno a muchos con Did
     */
    public function Dids()
    {
        return $this->hasMany('App\Dids');
    }
    /**
     * Relacion uno a muchos con Did
     */
    public function Canales()
    {
        return $this->hasMany('App\Canales');
    }
    /**
     * Relacion uno a uno con Config Empresas
     */
    public function Config_Empresas()
    {
        return $this->hasOne('App\Config_Empresas', 'Empresas_id', 'id');
    }
    /**
     * Relacion muchos a muchos con Modulos
     */
    public function Modulos()
    {
        return $this->belongsToMany('App\Modulos', 'Modulos_Empresas')->where('activo', 1)->orderBy('id');
    }
    /**
     * Relacion uno a uno con Cat_Estado_Empresas
     */
    public function Cat_Estado_Empresa()
    {
        return $this->hasOne('App\Cat_Estado_Empresa', 'id', 'Cat_Estado_Empresa_id');
    }
     /**
     * Relacion uno a muchos con Cat_Extensiones
     */
    public function Cat_Extensiones()
    {
        return $this->hasMany('App\Cat_Extensiones');
    }
    /**
     * Relacion uno a muchos con Sub_Formularios
     */
    public function Formularios()
    {
        return $this->hasMany('App\Formularios');
    }
    /**
     * Relacion uno a muchos con Speech
     */
    public function Speech()
    {
        return $this->hasMany('App\speech');
    }
    /**
     * Relacion uno a muchos con Agentes
     */
    public function Agentes()
    {
        return $this->hasMany('App\Agentes');
    }
    /**
     * Relacion uno a muchos con Speech
     */
    public function Eventos_Agentes()
    {
        return $this->hasMany('App\Eventos_Agentes');
    }
    /**
     * Relacion uno a muchos con Grabaciones
     */
    public function Grabaciones()
    {
        return $this->hasMany('App\Grabaciones');
    }
    /**
     * Relacion uno a muchos con almacenamiento
     */
    public function almacenamiento()
    {
        return $this->hasMany('App\almacenamiento');
    }
    /**
     * Relacion muchos a muchos con Cat_campos_plantillas
     */
    public function Cat_campos_plantillas()
    {
        return $this->belongsToMany('App\Cat_campos_plantillas', 'Campos_plantillas_empresa', 'fk_empresas_id', 'fk_cat_campos_plantilla_id');
    }
    /**
     * Relacion uno a muchos con Prefijos_marcacion
     */
    public function Prefijos_marcacion()
    {
        return $this->hasMany('App\Prefijos_marcacion');
    }
}
