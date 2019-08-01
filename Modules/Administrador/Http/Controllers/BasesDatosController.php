<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\BaseDatos;
use Nimbus\Http\Controllers\LogController;

class BasesDatosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos las base de datos que esten activos
         */
        $basesDatos = BaseDatos::where('activo',1)->get();
        return view('administrador::basedatos.index', compact('basesDatos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::basedatos.create');
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
        $db = BaseDatos::create( $request->all() );
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'BaseDatos',$mensaje, $db->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('basedatos.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        return view('administrador::basedatos.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la informacion de la base de datos ha editar
         */
        $baseDatos = BaseDatos::findOrFail( $id );
        return view('administrador::basedatos.edit', compact('baseDatos', 'id'));
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
        BaseDatos::where( 'id', $id )
                                ->update([
                                    'nombre' => $request->input('nombre'),
                                    'ip' => $request->input('ip'),
                                    'ubicacion' => $request->input('ubicacion')
                                ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'BaseDatos',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('basedatos.index');
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
        BaseDatos::where( 'id', $id )
                                ->update([
                                    'activo' => 0,
                                ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'BaseDatos',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('basedatos.index');
    }
}
