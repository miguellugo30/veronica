<?php

namespace Modules\Administrador\Http\Controllers;

use Nimbus\Categorias;
use Nimbus\Sub_Categorias;
use Nimbus\Modulos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use DB;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $categorias = Categorias::active()->get();

        return view('administrador::menus.index', compact('categorias') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Recuperamos todos los modulos que esten activos
         */
        $modulos = Modulos::active()
                            ->orderBy('prioridad', 'asc')
                            ->get();
         /**
         * Obtenemos los menus con estatus 1
         */
        $categorias = Categorias::active()->get();

        return view('administrador::menus.create', compact('categorias', 'modulos'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Insertamos la informacion del formulario en la tabla permissions como en la tabla de categorias
         */
        $request['permiso'] = ("view ".strtolower($request->input('nombre')));
        $permisoV = ("view ".strtolower($request->input('nombre')));
        $permisoC = ("create ".strtolower($request->input('nombre')));
        $permisoE = ("edit ".strtolower($request->input('nombre')));
        $permisoD = ("delete ".strtolower($request->input('nombre')));
        DB::table('permissions')->insert([
                                    'name' => $permisoV,
                                    'guard_name' => 'web'
                                        ]);
        DB::table('permissions')->insert([
                                    'name' => $permisoC,
                                    'guard_name' => 'web'
                                        ]);
        DB::table('permissions')->insert([
                                    'name' => $permisoE,
                                    'guard_name' => 'web'
                                        ]);
        DB::table('permissions')->insert([
                                    'name' => $permisoD,
                                    'guard_name' => 'web'
                                        ]);
        $cat = Categorias::create($request->all());
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Categorias',$mensaje, $cat->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $subCategorias = Sub_Categorias::where('id_categoria', $id)
                                        ->where('activo', 1)
                                        ->orderBy('prioridad', 'asc')
                                        ->get();


        return view('administrador::menus.show', compact('subCategorias','id'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
         /**
         * Obtenemos la informacion del menu a editar
         */
        $categoria = Categorias::findOrFail( $id );

        return view('administrador::menus.edit', compact( 'categoria' ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Actualizamos el menu
         */
        $request['permiso'] = ("view ".strtolower($request->input('nombre')));

        $permisoV = ("view ".strtolower($request->input('nombre')));
        $permisoC = ("create ".strtolower($request->input('nombre')));
        $permisoE = ("edit ".strtolower($request->input('nombre')));
        $permisoD = ("delete ".strtolower($request->input('nombre')));

        DB::table('permissions')->where('name', ("view ".strtolower($request->input('permi'))))->update([
                                                                                                    'name' => $permisoV
                                                                                                    ]);
        DB::table('permissions')->where('name', ("create ".strtolower($request->input('permi'))))->update([
                                                                                                    'name' => $permisoC
                                                                                                    ]);
        DB::table('permissions')->where('name', ("edit ".strtolower($request->input('permi'))))->update([
                                                                                                    'name' => $permisoE
                                                                                                    ]);
        DB::table('permissions')->where('name', ("delete ".strtolower($request->input('permi'))))->update([
                                                                                                    'name' => $permisoD
                                                                                                    ]);
         Categorias::where( 'id', $id )
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'descripcion' => $request->input('descripcion'),
                        'tipo' => $request->input('tipo'),
                        'permiso' => $request->permiso,
                    ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Categorias',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Ponemos en desactivo el registro seleccionado
         */
        Categorias::where( 'id', $id )
        ->update([
            'activo' => 0
            ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Categorias',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');

    }

    public function ordering()
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $categorias = Categorias::where('activo', 1)->orderByRaw('prioridad ASC')->get();

        return view('administrador::menus.ordering', compact('categorias') );

    }

    public function updateOrdering(Request $request)
    {

        $elementos = explode(',', $request->input('ordenElementos') );
        $prioridad = 1;

        for ($i=0; $i < count( $elementos ); $i++) {

            $id = explode('_',$elementos[$i] );

            Categorias::where( 'id', $id[1] )
                        ->update([
                            'prioridad' => $prioridad
                        ]);
            $prioridad++;
        }

        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');

    }
}
