<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_Estado_Empresa;

class CatEstadoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cat_empresas = Cat_Estado_Empresa::where('activo',1)->get();
        return view('administrador::cat_empresa.index', compact('cat_empresas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::cat_empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la informacion del formulario
         */
        Cat_Estado_Empresa::create(  $request->all() );
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_empresa.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la informacion del catalogo a editar
         */
        $cat_empresa = Cat_Estado_Empresa::findOrFail( $id );
        return view('administrador::cat_empresa.edit', compact('cat_empresa', 'id'));
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
         * Actualizamos los campos
         */
        Cat_Estado_Empresa::where( 'id', $id )
        ->update([
            'nombre' => $request->input('nombre')
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos los campos
         */
        Cat_Estado_Empresa::where( 'id', $id )
        ->update([
            'activo' => '0'
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_empresa.index');
    }
}
