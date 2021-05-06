<?php

namespace App\Http\Controllers;

use App\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Token_Soporte;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Modulos;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Dispatcher $events)
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( Request $request, Dispatcher $events)
    {

        $user = Auth::user();
        $pos = Str::contains($user->email, 'soporte_');

        if ( $pos === true )
        {
            /**
             * Obtenemos el id de usuario real que esta entrando soporte
             */
            $token = Token_Soporte::where( [ ['Empresas_id', '=', $user->id_cliente],['token', '=', $request->session()->get('token_soporte')] ] )->get();

            if ( $token->isEmpty() )
            {
                return abort(403, 'Token invalido, inicie una nueva sesión para soporte');
            }
            else
            {
                $request->session()->put('user_real', $token->first()->users_id);
            }
        }
        /**
         * Obtenemos el rol del usuario logeado
         **/
        $rol = $user->getRoleNames();
        /**
         * Verificamos que sea un usuario activo
         **/
        if ( $user->status == 1 )
        {
            /**
             * Si el rol es Super Administrador o  administrador lo redireccionamos a la vista administrador
             **/
            if ( $rol[0] == 'Super Administrador' )
            {
                return redirect('administrador');
            }
            else
            {
                $events->listen(BuildingMenu::class, function (BuildingMenu $event)
                {
                    $modulos = Empresas::with('Modulos')->where('id', Auth::user()->id_cliente)->first();
                    $menu = array();
                    foreach ($modulos->Modulos as $v)
                    {
                        $a = [
                            'text' => $v->nombre,
                            'id' => $v->id,
                            'url' => "",
                            'icon' => 'fas fa-angle-right',
                            'classes' => 'menu'
                        ];
                        array_push( $menu, $a );
                    }
                    $event->menu->add( ...$menu );
                });
                /**
                 * Obtenemos las categorias relacionadas al usuario
                 **/
                $categorias = array();

                $modulo = "Home";

                return view('home', compact( 'rol', 'categorias', 'modulo' ));
            }
        }
        else
        {
            return redirect('/')->withErrors('Usuario inactivo', 'message');
        }
    }
}
