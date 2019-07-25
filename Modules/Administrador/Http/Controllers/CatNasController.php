<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_NAS;

class CatNasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
        * Recuperamos todos los catalogos que esten activos
        */
        $cat_nas = Cat_NAS::where('activo',1)->get();
        return view('administrador::cat_nas.index', compact('cat_nas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::cat_nas.create');
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
        Cat_NAS::create(  $request->all() );
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_nas.index');
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
       /**
         * Obtenemos la informacion del catalogo a editar
         */
        $cat_nas = Cat_NAS::findOrFail( $id );
        return view('administrador::cat_nas.edit', compact('cat_nas', 'id'));
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
        Cat_NAS::where( 'id', $id )
        ->update([
            'nombre' => $request->input('nombre'),
            'ip_nas' => $request->input('ip_nas')
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_nas.index');
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
        Cat_NAS::where( 'id', $id )
        ->update([
            'activo' => '0'
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_nas.index');
    }
}
