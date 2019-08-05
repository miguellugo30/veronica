<?php

namespace Nimbus\Http\Controllers;
use Nimbus\User;
use Illuminate\Support\Facades\Auth;

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
    public function index()
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
            //dd( $rol );
            /**
             * Si el rol es Super Administrador o  administrador lo redireccionamos a la vista administrador
             */
            if ( $rol[0] == 'Super Administrador' ) {
                return redirect('administrador');
            } else {
                /**
                 * Obtenemos el rol del usuario logeado
                 */
                $rol = $user->getRoleNames();
                /**
                 * Obtenemos las categorias relacionadas al usuario
                 */
                $categorias = array();

                return view('home', compact( 'rol', 'categorias' ));
            }
        } else {
            return redirect('/')->withErrors('Usuario inactivo', 'message');
        }
    }
}
