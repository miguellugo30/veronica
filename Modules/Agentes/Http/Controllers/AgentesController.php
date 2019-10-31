<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Nimbus\Agentes;
use Nimbus\Campanas;
use Nimbus\Crd_Asignacion_Agente;
use Nimbus\Crd_Call_Center;
use Nimbus\Miembros_Campana;

class AgentesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $agente = auth()->guard('agentes')->user();

        return view('agentes::index', compact('agente'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('agentes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        Agentes::where( 'id', $request->id_agente )->update(['Cat_Estado_Agente_id' => 2]);
        Miembros_Campana::where( 'membername', $request->id_agente )->update(['Paused' => 0]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data = array();
        $agente = Agentes::active()->where('id',$id)->get()->first();

        if ( $agente->Cat_Estado_Agente_id == 4 || $agente->Cat_Estado_Agente_id == 8 ) {
            $data['status'] = 1;
            $data['estado'] = $agente->Cat_Estado_Agente->nombre;
            return json_encode( $data );
            //return view('agentes::show');
        } else {
            $data['status'] = 0;
            $data['estado'] = $agente->Cat_Estado_Agente->nombre;
            return json_encode( $data );
        }

        //return $id;

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $datos_llamada = Crd_Asignacion_Agente::where( 'Agentes_id', $id )->orderBy('id', 'desc')->first();

        $calledid = $datos_llamada->CDR_Detalles->CDR->first()->calledid;
        $callerid = $datos_llamada->CDR_Detalles->CDR->first()->callerid;

        if ( $datos_llamada->CDR_Detalles->aplicacion == 'Campanas' ) {
            $campana = Campanas::active()->where( 'id', $datos_llamada->CDR_Detalles->id_aplicacion )->get()->first();
        }

        $speech = $campana->speech;
        $grupo = $campana->Grupos->first();

        $historico = Crd_Call_Center::where('callerid', $callerid)->get();

        return view('agentes::show', compact( 'campana', 'calledid', 'speech', 'historico', 'grupo' ));
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
