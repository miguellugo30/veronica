<?php

namespace Modules\Administrador\Http\Controllers;

use App\Sub_Categorias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Controllers\LogController;
use DB;
use Modules\Administrador\Http\Requests\SubMenusRequest;

class SubMenuscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('administrador::submenus.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::submenus.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SubMenusRequest $request)
    {
        /**
         * Insertamos la informacion del formulario en la tabla permissions como en la tabla sub_categorias
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

        $cat = Sub_Categorias::create($request->all());
         /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Sub_Categorias',$mensaje, $cat->id);
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
        return view('administrador::submenus.show');
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
        $subCategoria = Sub_Categorias::findOrFail( $id );

        return view('administrador::submenus.edit', compact( 'subCategoria', 'id' ) );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SubMenusRequest $request, $id)
    {
        /**
         * Actualizamos el Sub Menu
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
        Sub_Categorias::where( 'id', $id )
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
        $log->store('Actualizacion', 'Sub_Categorias',$mensaje, $id);
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
    public function destroy( Request $request, $id)
    {
        /**
         * Buscamos el id en las Sub_Categorias
         */
        $SubCategoria = Sub_Categorias::findOrFail( $id );

        /**
         * Formateamos las variables para que en base al nombre del permiso podamos posteriormente borrarlas de la tabla permissions
         */
        $permisoV = str_replace('view','view',$SubCategoria->permiso);
        $permisoC = str_replace('view','create',$SubCategoria->permiso);
        $permisoE = str_replace('view','edit',$SubCategoria->permiso);
        $permisoD = str_replace('view','delete',$SubCategoria->permiso);

        /**
         * Borramos de la tabla permissions las Sub_Categorias
         */
        DB::table('permissions')->where('name','=',$permisoV)->delete();
        DB::table('permissions')->where('name','=',$permisoC)->delete();
        DB::table('permissions')->where('name','=',$permisoE)->delete();
        DB::table('permissions')->where('name','=',$permisoD)->delete();

        Sub_Categorias::where( 'id', $id )
        ->update([
            'activo' => 0
            ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Sub_Categorias',$mensaje, $id);
        $id = $request->input('id_categoria');
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');
    }

    public function ordering( $id )
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $subCategorias = Sub_Categorias::where('id_categoria', $id )->where('activo', 1)->orderByRaw('prioridad ASC')->get();

        return view('administrador::submenus.ordering', compact('subCategorias', "id") );

    }

    public function updateOrdering(Request $request)
    {

        $elementos = explode(',', $request->input('ordenElementos') );
        $prioridad = 1;

        for ($i=0; $i < count( $elementos ); $i++) {

            $id = explode('_',$elementos[$i] );

            Sub_Categorias::where( 'id', $id[1] )
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
