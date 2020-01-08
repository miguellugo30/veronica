<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Agentes\Http\Controllers\EventosAgenteController;
use Modules\Agentes\Http\Controllers\CalificarLlamadaController;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use DB;
use Nimbus\Http\Controllers\ZonaHorariaController;

use Nimbus\Agentes;
use Nimbus\Eventos_Agentes;
use Nimbus\Crd_Asignacion_Agente;
use Nimbus\Campanas;
use Nimbus\Miembros_Campana;


class RealTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('inbound::RealTime.index');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $agentes = Agentes::empresa( $empresa_id )->active()->get();

        return view('inbound::RealTime.show', compact('agentes'));
    }
    /**
     * Funcion para obtener la pantalla del agente
     */
    public function real_time_agente($id)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Verificamos que el agente sea de la empresa
         */
        $agente = Agentes::empresa( $empresa_id )->where('id', $id)->active()->get();

        if (  $agente->isNotEmpty() )
        {
            $modalidad = DB::table('Campanas')
                        ->join( 'Miembros_Campanas', 'Campanas.id', '=', 'Miembros_Campanas.Campanas_id' )
                        ->select(
                                    'Campanas.modalidad_logue'
                                )
                        ->where('Campanas.activo', 1)
                        ->where('Miembros_Campanas.membername', $id)
                        ->groupBy('modalidad_logue')
                        ->first();
            //$evento = $request->evento;
            $evento = '';
            $agente = $agente[0];
            $eventosAgente = Eventos_Agentes::active()->where('Empresas_id', $empresa_id)->get();
            return view('agentes::index', compact('agente', 'evento', 'eventosAgente', 'modalidad'));

        }
        else
        {
            return abort(403, 'Agente Invalido, no existe el agente o no pertenece a la empresa en uso.');
        }
    }
    /**
     * Función para obtener el estatus del agente
     */
    public function real_time_agente_status($id)
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
     * Función para obtener los datos de la llamada
     */
    public function real_time_agente_llamada($id)
    {
        /**
         * Obtenemos la llamada que fue asignada al agente
         */
        $datos_llamada = Crd_Asignacion_Agente::where( 'Agentes_id', $id )->orderBy('id', 'desc')->limit(1)->get();
	    $cdrDetalle = $datos_llamada[0]->CDR_Detalles->orderBy('id', 'desc')->limit(1)->get();
	    /**
         * Obtenemos el CALLED y CALLER
         */
        $calledid = $datos_llamada[0]->CDR_Detalles->CDR->first()->calledid;
        $callerid = $datos_llamada[0]->CDR_Detalles->CDR->first()->callerid;
        $canal = $datos_llamada[0]->canal;
        $uniqueid = $datos_llamada[0]->uniqueid;
        /**
         * Obtenemos la informacion de la campana a la cual esta el agente y la llamada
         */
        if ( $cdrDetalle->first()->aplicacion == 'Campanas' ) {
            $campana = Campanas::active()->where( 'id', $cdrDetalle->first()->id_aplicacion )->get()->first();
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
     * Funcion para colgar llamada
     * Esta funcion sirve para colgar solo la llamada,
     * esto desde el boton de colgar en la pantalla del agente
     */
    public function colgar( Request $request )
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Generamos un evento para colgar la llamada
         */
        EventosAmiController::colgar_llamada( $request->canal, $empresa_id );
    }
    /**
     * Función para poner como no disponible a un agente
     */
    public function no_disponible( Request $request )
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $agente =  $request->id_agente;
        $evento = '';

        EventosAgenteController::no_disponible_real_time( $request->id_agente, $empresa_id );

        return view('agentes::cronometro', compact( 'agente', 'evento' ));
    }
    /**
     * Función para poner como  disponible a un agente
     */
    public function agente_disponible( Request $request )
    {
        $agente = Agentes::find( $request->agente );
        EventosAgenteController::agente_disponible_real_time( $request, $agente->id, $agente->Empresas_id );
    }
    /**
     * Función para mostrar el historial de llamadas contestadas
     */
    public function historial_llamadas( Request $request )
    {
        $historico = EventosAgenteController::historial_llamadas( $request );

        $inbound = $historico->where('tipo', 'Inbound')->sortByDesc('fecha_inicio');
        $outbound = $historico->where('tipo', 'Outbound')->sortByDesc('fecha_inicio');
        $manual = $historico->where('tipo', 'Manual')->sortByDesc('fecha_inicio');

        return view('agentes::historial_llamadas', compact( 'inbound', 'outbound', 'manual' ) );
    }
     /**
     * Función para mostrar el historial de llamadas contestadas
     */
    public function llamadas_abandonadas( Request $request )
    {
        $historico = EventosAgenteController::llamadas_abandonadas( $request );

        $inbound = $historico->where('tipo', 'Inbound')->sortByDesc('fecha_inicio');
        $outbound = $historico->where('tipo', 'Outbound')->sortByDesc('fecha_inicio');
        $manual = $historico->where('tipo', 'Manual')->sortByDesc('fecha_inicio');

        return view('agentes::historial_llamadas', compact( 'inbound', 'outbound', 'manual' ) );
    }
    /**
     * Función para poner como  disponible a un agente
     */
    public function logeoExtension( Request $request )
    {
        $agente = Agentes::find( $request->idAgente );
        EventosAgenteController::logeoExtension( $agente );
    }
    /**
     * Función para calificar la llamada
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $fecha = ZonaHorariaController::zona_horaria( $empresa_id );
        /**
         * Ponemos al agente en disponible.
         */
        Agentes::where( 'id', $request->id_agente )->update(['Cat_Estado_Agente_id' => 2]);
        /**
         * Dentro de la campana lo ponemos como despausado.
         */
        Miembros_Campana::where( 'membername', $request->id_agente )->update(['Paused' => 0]);
        /**
         * Actualizamos la fecha de calificación.
         */
        Crd_Asignacion_Agente::where('uniqueid', $request->uniqueid)->update(['fecha_calificacion' => $fecha]);
        /**
         * Generamos el evento para colgar llamada.
         */
        EventosAmiController::colgar_llamada( $request->canal, $empresa_id );
        /**
         * Despausamos al agente directamente en el MS.
         */
        $despausar = EventosAmiController::despausar_agente( $request->canal, 'unpause', $empresa_id );
        /**
         * Guardamos la calificación de la llamada.
         */
        CalificarLlamadaController::calificarllamada( $request );
    }
}
