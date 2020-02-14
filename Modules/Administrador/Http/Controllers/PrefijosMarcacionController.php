<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\PrefijosMarcacion;
use Nimbus\User;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;

class PrefijosMarcacionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Recuperamos todos los Prefijos que esten activos
         */
        $Prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$empresa_id)->get();
        return view('administrador::prefijos_marcacion.index', compact('Prefijos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        return view('administrador::prefijos_marcacion.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Creamos los datos del formulario en la tabla Prefijos_Marcacion
         */
        $prefijos = PrefijosMarcacion::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'prefijo' => $request->input('prefijo'),
            'prefijo_nuevo' => $request->input('prefijoNuevo'),
            'fk_empresas_id' => $request->input('id'),
            'activo' => 1
        ]);

        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, información capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Inserción', 'Prefijos_marcacion',$mensaje, $request->input('id'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($idEmpresa)
    {
        /**
         * Recuperamos todos los Prefijos que esten activos
         */
        $Prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$idEmpresa)->get();
        return view('administrador::prefijos_marcacion.show', compact('idEmpresa','Prefijos'));
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
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 5 );

        for ($i=0; $i < count($info); $i++) {
            PrefijosMarcacion::where([
                                       ['id', '=', $info[$i][0]],
                                       ['fk_empresas_id', '=', $id],
                                    ])->update([
                                        'nombre' => $info[$i][1],
                                        'descripcion' => $info[$i][2],
                                        'prefijo' => $info[$i][3],
                                        'prefijo_nuevo' => $info[$i][4],
                                    ]);

        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$info[$i][0].', informacion editada: '.var_export($info[$i], true);
        $log = new LogController;
        $log->store('Actualizacion', 'Prefijos_marcacion',$mensaje, $id);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos el prefijo a activo 0
         */
        PrefijosMarcacion::where('id',$id)->update([
            'activo' => 0,
        ]);
    }
}
