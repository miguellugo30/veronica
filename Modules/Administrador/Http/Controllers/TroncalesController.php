<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Troncales;
use Nimbus\Cat_Distribuidor;
use Nimbus\Cat_IP_PBX;

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
        $troncales = Troncales::where('activo',1)->get();
        
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
        $distribuidores = Cat_Distribuidor::where('activo',1)->get();

        $medias = Cat_IP_PBX::where('activo',1)->get();
        return view('administrador::troncales.create', compact('distribuidores','medias'));
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
        Troncales::create( $request->all() );
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
        $configuracion = Troncales::findOrFail($id);
        

        return view('administrador::troncales.show', compact('configuracion'));
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
        $distribuidores = Cat_Distribuidor::where('activo',1)->get();
        /**
         * Obtenemos la informacion de la troncal a editar
         */
        $troncal = Troncales::findOrFail( $id );

        $medias = Cat_IP_PBX::where('activo',1)->get();

        return view('administrador::troncales.edit', compact('troncal', 'id', 'distribuidores','medias') );
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
         * Actualizamos la troncal
         */
        Troncales::where( 'id', $id )
                                ->update([
                                    'nombre' => $request->input('nombre'),
                                    'ip_media' => $request->input('ip_media'),
                                    'ip_host' => $request->input('ip_host'),
                                    'Cat_Distribuidor_id' => $request->input('Cat_Distribuidor_id'),
                                ]);
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
