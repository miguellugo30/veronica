<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;

use Nimbus\User;
use Nimbus\Agentes;


class AgentesController extends Controller
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

        $agentes = Agentes::active()->where('Empresas_id',$empresa_id)->get();
        return view('settings::Agentes.index',compact('agentes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('settings::Agentes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Insertamos la informacion del Agente
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $datos = $request->all();
        $datos['Empresas_id']=$empresa_id;
        $agente = Agentes::create($datos);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Agentes',$mensaje, $agente->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('Agentes.index');
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
        $agente = Agentes::where('id',$id)->first();
        return view('settings::Agentes.edit',compact('agente'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //$dataForm = $request->input('dataForm');
        //dd($request);
        //for($i=0;$i<count($info);$i++){

            Agentes::where( 'id', $id )
            ->update([
                    'nombre' => $request->input('nombre'),
                    'usuario' => $request->input('usuario'),
                    'contrasena' => $request->input('contrasena'),
                    'extension' => $request->input('extension')
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request, true);
            $log = new LogController;
            $log->store('Actualizacion', 'Categorias',$mensaje, $id);
            return redirect()->route('Agentes.index');
        //}
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Agentes::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('Agentes.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'User', $mensaje, $id);

    }
}
