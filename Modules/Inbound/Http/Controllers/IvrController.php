<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Ivr;
use Nimbus\Audios_Empresa;


class IvrController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $ivrs = Ivr::active()->where('Empresas_id',$empresa_id)->get();
        $data = array();
        foreach ($ivrs as $ivr) {

           $datos = [ $ivr->id, $ivr->nombre, $ivr->tiempo_espera, $ivr->repeticiones ]; 
            $info = [ $ivr->mensaje_bienvenida_id, $ivr->mensaje_tiepo_espera_id, $ivr->mensaje_opcion_invalida_id ];
            
            $audios = Audios_Empresa::find($info);

            foreach ($audios as $audio) {
                
                array_push($datos, $audio->nombre);
            }

            array_push($data, $datos);
        }

        
        return view('inbound::Ivr.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $audios = Audios_Empresa::active()->where('Empresas_id',$empresa_id)->get();

        return view('inbound::Ivr.create',compact('empresa_id','audios'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
        * Insertar información del Ivr
        */
        Ivr::create(
            [
                'nombre' => $request->input('nombre'),
                'mensaje_bienvenida_id'   => $request->input('mensaje_bienvenida_id'),
                'tiempo_espera' => $request->input('tiempo_espera'),
                'mensaje_tiepo_espera_id' => $request->input('mensaje_tiepo_espera_id'),
                'mensaje_opcion_invalida_id' => $request->input('mensaje_opcion_invalida_id'),
                'repeticiones' => $request->input('repeticiones'),
                'Empresas_id' => $request->input('Empresas_id')
            ]
        );
        return redirect()->route('Ivr.index');
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Creacion', 'Ivr',$mensaje, $user->id);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $audios = Audios_Empresa::active()->where('Empresas_id',$empresa_id)->get();


        $ivr = Ivr::active()->where('id',$id)->get();
        //dd($ivr);

        return view('inbound::Ivr.edit',compact('ivrs','audios'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Ivr::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('Ivr.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Ivr', $mensaje, $id);
    }
}
