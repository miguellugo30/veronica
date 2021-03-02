<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Str;
/**
 * Modelos
 */
use App\Categorias;


class AdministradorController extends Controller
{

    public function __construct(Dispatcher $events)
    {

        $this->middleware('auth');

        $events->listen(BuildingMenu::class, function (BuildingMenu $event)
        {
            $categorias = Categorias::active()->where('modulos_id', 18)->with('Sub_Categorias')->get();
            $menu = array();

            foreach ($categorias as $v)
            {
                $a = [
                    'text' => $v->nombre,
                    'key' => Str::camel($v->nombre),
                    'id' => $v->id,
                    'url' => "",
                    'icon' => $v->class_icon,
                    'can' => $v->permiso,
                    'clase' => 'menu'
                ];

                $sub_menu = array();

                if ( $v->Sub_Categorias->isNotEmpty() )
                {
                    foreach ($v->Sub_Categorias as $k)
                    {
                        $e = [
                                'text' => $k->nombre,
                                'id' => $k->id,
                                'can' => $k->permiso,
                                'url'  => '',
                            ];

                        array_push( $sub_menu, $e );
                    }
                    $a['submenu'] = $sub_menu;
                }
                array_push( $menu, $a );
           }
           $event->menu->add( ...$menu );
        });
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = Auth::user();
        /**
         * Obtenemos el rol del usuario logeado
         */
        $rol = array('Super Administrador');
        /**
         * Obtenemos las categorias relacionadas al usuario
         */
        $categorias = Categorias::active()->where('modulos_id', 13)->with('Sub_Categorias')->get();

        //dd( $rol );

        $modulo = "Administrador";

        return view('administrador::index', compact( 'rol', 'categorias', 'modulo' ) );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $rol        = Session::get('rol');
        $categorias = Session::get('categorias');

        return view('administrador::create', compact( 'rol', 'categorias' ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administrador::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('administrador::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
