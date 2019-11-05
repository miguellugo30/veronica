<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use PHPAMI\Ami;

use Nimbus\Agentes;
use Nimbus\Campanas;
use Nimbus\Crd_Asignacion_Agente;
use Nimbus\Miembros_Campana;

class AgentesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index( Request $request )
    {
        $evento = $request->evento;
        $agente = auth()->guard('agentes')->user();


        return view('agentes::index', compact('agente', 'evento'));
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

        $ami = new Ami();
        if ($ami->connect('10.255.242.136:5038', 'Call_Center', 'Call_C3nt3r_1nf1n1t', 'off') === false) {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $ami->command('hangup request '.$request->canal);

        $ami->disconnect();

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
        } else {
            $data['status'] = 0;
            $data['estado'] = $agente->Cat_Estado_Agente->nombre;
            return json_encode( $data );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la llamada que fue asignada al agente
         */
        $datos_llamada = Crd_Asignacion_Agente::where( 'Agentes_id', $id )->orderBy('id', 'desc')->first();
        /**
         * Obtenemos el CALLED y CALLER
         */
        $calledid = $datos_llamada->CDR_Detalles->CDR->first()->calledid;
        $callerid = $datos_llamada->CDR_Detalles->CDR->first()->callerid;
        $canal = $datos_llamada->canal;
        /**
         * Obtenemos la informacion de la campana a la cual esta el agente y la llamada
         */
        if ( $datos_llamada->CDR_Detalles->aplicacion == 'Campanas' ) {
            $campana = Campanas::active()->where( 'id', $datos_llamada->CDR_Detalles->id_aplicacion )->get()->first();
        }
        /**
         * Obtenemos el Speech y el grupo de calificaciones
         */
        $speech = $campana->speech;
        $grupo = $campana->Grupos->first();
        /**
         * Obtenemos el historico de llamdas de cliente
         */

        $historico = DB::table('Cdr_call_center')
                    ->join( 'Cdr_call_center_detalles', 'Cdr_call_center.uniqueid', '=', 'Cdr_call_center_detalles.uniqueid' )
                    ->join( 'Cdr_Asignacion_Agente', 'Cdr_call_center_detalles.uniqueid', '=', 'Cdr_Asignacion_Agente.uniqueid' )
                    ->join( 'Agentes', 'Cdr_Asignacion_Agente.Agentes_id', '=', 'Agentes.id' )
                    ->select(
                                'Cdr_call_center.uniqueid',
                                'Cdr_call_center.callerid',
                                'Cdr_call_center.calledid',
                                'Cdr_call_center.fecha_inicio',
                                'Cdr_call_center_detalles.aplicacion',
                                'Cdr_call_center_detalles.id_aplicacion',
                                'Agentes.nombre',
                                DB::raw("IF(Cdr_call_center_detalles.aplicacion='Campana','', (SELECT Campanas.nombre FROM Campanas WHERE Campanas.id = Cdr_call_center_detalles.id_aplicacion)) AS campana")
                            )
                    ->where('Cdr_call_center.callerid', $callerid)->get();

        return view('agentes::show', compact( 'campana', 'calledid', 'speech', 'historico', 'grupo', 'canal' ));
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
