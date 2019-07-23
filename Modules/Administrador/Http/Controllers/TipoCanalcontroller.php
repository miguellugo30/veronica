<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_Tipo_Canales;
use Nimbus\Cat_Distribuidor;

class TipoCanalcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tipocanales = Cat_Tipo_Canales::where('activo',1)->get();
        //dd($tipocanales);
        return view('administrador::cat_tipo_canal.index',compact('tipocanales'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $catdistriuidor = Cat_Distribuidor::where('activo',1)->get();
        return view('administrador::cat_tipo_canal.create',compact('catdistriuidor'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request);
        /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la informacion del formulario
         */
        Cat_Tipo_Canales::create( $request->all() );
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_tipo_canales.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Esta funcion se utilizara para poder mostrar los tipo de canales
         * al seleccionar el distribuidor, esto a la hora de dar de alta un canal
         */
        $tipocanales = Cat_Tipo_Canales::where('Cat_Distribuidor_id', $id)->get();

        return view('administrador::cat_tipo_canal.show', compact('tipocanales'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $tipocanales = Cat_Tipo_Canales::findOrFail($id);
        $catdistriuidor = Cat_Distribuidor::where('activo',1)->get();
        return view('administrador::cat_tipo_canal.edit',compact('catdistriuidor','tipocanales'));
        //dd($tipocanales);
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
        Cat_Tipo_Canales::where( 'id', $id )
                                ->update([
                                    'nombre' => $request->input('nombre'),
                                    'prefijo' => $request->input('prefijo'),
                                    'Cat_Distribuidor_id' => $request->input('Cat_Distribuidor_id')
                                ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_tipo_canales.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos la troncal
         */
        Cat_Tipo_Canales::where( 'id', $id )
                                ->update([
                                    'activo' => 0
                                ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_tipo_canales.index');
    }
}
