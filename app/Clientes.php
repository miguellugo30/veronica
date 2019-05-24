<?php

namespace Nimbus;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public function users()
    {
        return $this->hasMany('Nimbus\User', 'id_cliente');
    }
}
