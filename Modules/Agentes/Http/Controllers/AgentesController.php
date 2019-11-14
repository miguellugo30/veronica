<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use Modules\Agentes\Http\Controllers\CalificarLlamadaController;

use Nimbus\Agentes;
use Nimbus\Campanas;
use Nimbus\Crd_Asignacion_Agente;
use Nimbus\Miembros_Campana;
use Nimbus\Eventos_Agentes;

class AgentesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index( Request $request )
    {
        $modalidad = DB::table('Campanas')
                    ->join( 'Miembros_Campanas', 'Campanas.id', '=', 'Miembros_Campanas.Campanas_id' )
                    ->select(
                                'Campanas.modalidad_logue'
                            )
                    ->where('Campanas.activo', 1)
                    ->where('Miembros_Campanas.Agentes_id', auth()->guard('agentes')->id())
                    ->groupBy('modalidad_logue')
                    ->first();

        $evento = $request->evento;
        $agente = auth()->guard('agentes')->user();
        $eventosAgente = Eventos_Agentes::active()->where('Empresas_id', $agente->Empresas_id)->get();

        return view('agentes::index', compact('agente', 'evento', 'eventosAgente', 'modalidad'));
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
        EventosAmiController::colgar_llamada( $request->canal );
        CalificarLlamadaController::calificarllamada( $request );


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
        } else if( $agente->Cat_Estado_Agente_id == 3 ) {
            $data['status'] = 2;
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
        $uniqueid = $datos_llamada->uniqueid;
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
                    ->where('Cdr_call_center.callerid', $callerid)
                    ->whereDate('Cdr_call_center.fecha_inicio', DB::raw('curdate()'))->get();

        return view('agentes::show', compact( 'campana', 'calledid', 'speech', 'historico', 'grupo', 'canal', 'uniqueid' ));
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
