<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\Grupos;
use Nimbus\User;


class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $grupos = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Agentes']])->get();

        return view('settings::Grupos.index',compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('settings::Grupos.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $datos = $request->all();
        $datos['tipo_grupo']  = 3;
        $datos['Empresas_id'] = $empresa_id;
        Grupos::create($datos);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, información capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Grupos',$mensaje, $user->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('Grupos.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $grupo = Grupos::where('id',$id)->first();

        return view('settings::Grupos.edit',compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Grupos::where( 'id', $id )
            ->update([
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion')
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', información editada: '.var_export($request, true);
            $log = new LogController;
            $log->store('Actualización', 'Grupos',$mensaje, $id);
            return redirect()->route('Grupos.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Grupos::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('Grupos.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'Grupos', $mensaje, $id);
    }
}
