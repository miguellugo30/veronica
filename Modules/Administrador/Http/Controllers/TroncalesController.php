<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Troncales;
use Nimbus\Empresas;

class TroncalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos las troncales que esten activos
         */
        $troncales = Troncales::with('Empresas')->where('activo',1)->get();
        return view('administrador::troncales.index', compact('troncales'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Recuperamos todos las troncales que esten activos
         */
        $empresas = Empresas::where('activo',1)->get();
        return view('administrador::troncales.create', compact('empresas'));
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
        $troncal = Troncales::create(  $request->all() );
        /**
         * Vinculamos la troncal a las empresas seleccionadas
         */
        $troncal->empresas()->attach( $request->input('id_empresa') );
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $empresas = Empresas::findOrFail($id);
        $troncales = $empresas->troncales;

        return view('administrador::troncales.show', compact('troncales'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Recuperamos todos las troncales que esten activos
         */
        $empresas = Empresas::where('activo',1)->get();
        /**
         * Obtenemos la informacion de la troncal a editar
         */
        $troncal = Troncales::findOrFail( $id );
        /**
         * Creamos arreglo para las empresas que estan vinculadas a la troncal
         */
        $selectEmpresa = $troncal->Empresas->pluck('id')->toArray();

        return view('administrador::troncales.edit', compact('troncal', 'id', 'empresas', 'selectEmpresa') );
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
         * Actualizamos la trocal
         */
        $troncal = Troncales::where( 'id', $id )
                                ->update([
                                    'nombre' => $request->input('nombre'),
                                    'troncal_sansay' => $request->input('troncal_sansay')
                                ]);

        /**
         * Buscamos la trocal para asociosar/desaciosar empresas
         */
        $troncal = Troncales::findOrFail( $id );
        /**
         * Vinculamos la troncal a la empresa
         */
        $troncal->empresas()->detach();//Desasociamos todas las empresas a la troncal
        $troncal->empresas()->attach( $request->input('id_empresa') );//Asociamos todas las empresas a la troncal
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos la trocal ha activo 0
         */
        Troncales::where( 'id', $id )
                   ->update([
                       'activo' => '0',
                   ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }
}
