<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_estado_campanas extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'descripcion_estado',
    ];
    /**
     * Nombre de la tabla que se ocupra
     */
    protected $table = 'Cat_estado_campanas';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    /**
     * Relacion muchos a uno Campanas
     */
    public function Campanas()
    {
        return $this->belongsToMany('App\Campanas', 'Campanas_activas', 'fk_campanas', 'fk_cat_estado_campanas');
    }
}
