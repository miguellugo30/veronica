<?php

namespace Nimbus\Http\Controllers;

use Carbon\Carbon;
use Nimbus\Token_Soporte;
use Nimbus\User;

class SoporteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($token)
    {

        $sesion = Token_Soporte::where('token', $token)->get()->first();
        $caducidad = Carbon::parse( $sesion->caducidad );

        if ( $caducidad->lessThanOrEqualTo(date('Y-m-d H:i:s')) )
        {
            return abort(403, 'Token invalido, inicie una nueva sesión para soporte');
        }
        else
        {
            $usuarioSoporte = User::where([ ['id_cliente', '=', $sesion->Empresas_id],['email','like','soporte_'.$sesion->Empresas_id.'%'] ])->get()->first();
            $email = $usuarioSoporte->email;
            //$password = $usuarioSoporte->password;
            $password = '12345678';

            return view('auth/login', compact( 'email', 'password', 'token' ));
        }
    }
}
