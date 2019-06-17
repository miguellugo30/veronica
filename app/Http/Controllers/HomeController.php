<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Nimbus\User;
use Illuminate\Support\Facades\Auth;
use Nimbus\Http\Controllers\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( Request $request )
    {
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        /**
         * Verificamos que sea un usuario activo
         */
        if ( $user->status == 1 ) {
            /**
             * Obtenemos el rol del usuario logeado
             */
            $rol = $user->getRoleNames();
            /**
             * Obtenemos las categorias relacionadas al usuario
             */
            $categorias = $user->categorias;
            /**
             * Almacenamos las categorias y rol del usuaro en variable de sesion
             */
            session(['categorias' => $categorias]);
            session(['rol'        => $rol[0] ]);
            /**
             * Si el rol es Super Administrador o  administrador lo redireccionamos a la vista administrador
             */
            if ( $rol[0] == 'Super Administrador' ) {
                return redirect('administrador');
            } else {
                return view('home');
            }
        } else {
            return redirect('/')->withErrors('Usuario inactivo', 'message');
        }
    }
}
