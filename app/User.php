<?php

namespace Nimbus;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_cliente',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Relacion muchos a muchos con Categorías
     */
    public function categorias()
    {
        return $this->belongsToMany('Nimbus\Categorias')->active()->orderBy('prioridad');
    }
    /**
     * Relación muchos a uno con Empresas
     */
    public function Empresas()
    {
        return $this->belongsTo('Nimbus\Empresas', 'Empresas_id');
    }
    /**
     * Relación uno a muchos con Logs
     */
    public function Logs()
    {
        return $this->hasMany('Nimbus\Empresas');
    }
    /**
     * Relación uno a muchos con Token Soporte
     */
    public function Token_Soporte()
    {
        return $this->hasMany('Nimbus\Token_Soporte');
    }

}
