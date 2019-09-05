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

        return view('inbound::Ivr.index',compact('ivrs'));
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
        return view('inbound::edit');
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
        //
    }
}