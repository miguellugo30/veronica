<?php

namespace Modules\Administrador\Http\Controllers;

use Nimbus\Sub_Categorias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

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
    public function store(Request $request)
    {

        //dd( $request );

       /**
         * Obtenemos todos los datos del formulario de alta
         */
        $input = $request->all();
        /**
         * Insertamos la informacion del formulario
         */
        $user = Sub_Categorias::create($input);
         /**
         * Obtenemos los menus con estatus 1
         */
        $id = $request->input('id_categoria');

        $subCategorias = Sub_Categorias::where('id_categoria', $id )
                                        ->where('activo', 1)
                                        ->orderBy('prioridad', 'asc')
                                        ->get();

        return view('administrador::menus.show', compact('subCategorias','id'));
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
    public function update(Request $request, $id)
    {
        Sub_Categorias::where( 'id', $id )
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'descripcion' => $request->input('descripcion'),
                        'tipo' => $request->input('tipo'),
                    ]);

        $id = $request->input('id_categoria');

        $subCategorias = Sub_Categorias::where('id_categoria', $id )
        ->where('activo', 1)
        ->orderBy('prioridad', 'asc')
        ->get();

        return view('administrador::menus.show', compact('subCategorias','id'));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy( Request $request, $id)
    {
        Sub_Categorias::where( 'id', $id )
        ->update([
            'activo' => 0
            ]);

        $id = $request->input('id_categoria');
        /**
         * Obtenemos los menus con estatus 1
         */
        $subCategorias = Sub_Categorias::where('id_categoria', $id )
        ->where('activo', 1)
        ->orderBy('prioridad', 'asc')
        ->get();

        return view('administrador::menus.show', compact('subCategorias','id'));
    }

    public function ordering( $id )
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $subCategorias = Sub_Categorias::where('id_categoria', $id )->where('activo', 1)->orderByRaw('prioridad ASC')->get();

        return view('administrador::submenus.ordering', compact('subCategorias') );

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

        $id = $request->input('id_categoria');
        /**
         * Obtenemos los menus con estatus 1
         */
        $subCategorias = Sub_Categorias::where('id_categoria', $id )
        ->where('activo', 1)
        ->orderBy('prioridad', 'asc')
        ->get();

        return view('administrador::menus.show', compact('subCategorias','id'));

    }
}
