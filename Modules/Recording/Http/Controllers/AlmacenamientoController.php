<?php

namespace Modules\Recording\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\User;
use Illuminate\Support\Facades\Auth;
USE Nimbus\Almacenamiento;
USE Nimbus\Config_Empresas;
USE DB;
class AlmacenamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos los datos del usuario Logueado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $inbound = Almacenamiento::active()->where('Empresas_id',$empresa_id)->sum('grabaciones_entrada');
        $outbound = Almacenamiento::active()->where('Empresas_id',$empresa_id)->sum('grabaciones_salida');
        $manual = Almacenamiento::active()->where('Empresas_id',$empresa_id)->sum('grabaciones_manuales');
        $buzon = Almacenamiento::active()->where('Empresas_id',$empresa_id)->sum('buzon_voz');
        $audios = Almacenamiento::active()->where('Empresas_id',$empresa_id)->sum('audios_empresa');
        $config_empresas = Config_Empresas::where('Empresas_id',$empresa_id)->get();

        return view('recording::Almacenamiento.index',compact('empresa_id','inbound','outbound','manual','buzon','audios','config_empresas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('recording::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('recording::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('recording::edit');
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
