<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use Modules\Agentes\Http\Controllers\CalificarLlamadaController;
use Modules\Agentes\Http\Controllers\EventosAgenteController;
use Nimbus\Http\Controllers\ZonaHorariaController;

use Nimbus\Agentes;
use Nimbus\Campanas;
use Nimbus\Crd_Asignacion_Agente;
use Nimbus\Miembros_Campana;
use Nimbus\Eventos_Agentes;

class AgentesController extends Controller
{
    /**
     * Función para mostrar la pantalla del agente
     */
    public function index( Request $request )
    {
        /**
         * Obtenemos la modalidad en la cual esta el agente
         */
        $modalidad = DB::table('Campanas')
                    ->join( 'Miembros_Campanas', 'Campanas.id', '=', 'Miembros_Campanas.Campanas_id' )
                    ->select(
                                'Campanas.modalidad_logue'
                            )
                    ->where('Campanas.activo', 1)
                    ->where('Miembros_Campanas.membername', auth()->guard('agentes')->id())
                    ->groupBy('modalidad_logue')
                    ->first();

        $evento = $request->evento;
        /**
         * Obtenemos los datos del agente
         */
        $agente = auth()->guard('agentes')->user();
        /**
         * Obtenemos los eventos por los cuales podrá ser pausado el agente
         */
        $eventosAgente = Eventos_Agentes::active()->where('Empresas_id', $agente->Empresas_id)->get();

        return view('agentes::index', compact('agente', 'evento', 'eventosAgente', 'modalidad'));
    }
    /**
     * Función para calificar la llamada
     */
    public function store(Request $request)
    {
        $user = auth()->guard('agentes')->user();
        $empresa_id = $user->Empresas_id;

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
    /**
     * Función para saber el estado del agente
     */
    public function show($id)
    {
        $data = array();
        /**
         * Recuperamos el estado del agente
         */
        $agente = Agentes::select('Cat_Estado_Agente_id', 'monitoreo')->active()->where('id',$id)->get()->first();
        $data['monitoreo'] = $agente->monitoreo;
        /**
         * Estado 4 y 8 en llamada
         * Estado 3 en pausa
         */
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
     * Mostrar la información de la llamada en curso
     */
    public function edit($id)
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
         * Obtenemos la información de la campana a la cual esta el agente y la llamada
         */
        if ( $cdrDetalle->first()->aplicacion == 'Campanas' ) {
            $campana = Campanas::active()->where( 'id', $cdrDetalle->first()->id_aplicacion )->get()->first();
        }
        /**
         * Obtenemos el Speech y el grupo de calificaciones
         */
        $speech = $campana->speech;
        $campos = $speech->Opciones_Speech;

        if ( $speech->tipo == 'dinamico' )
        {
            $bienvenida = DB::table('Opciones_Speech AS OS')
                                ->join('appLaravel.speech AS S', 'OS.speech_id_hijo', '=', 'S.id')
                                ->select(
                                    'S.texto'
                                )
                                ->where('OS.id', $campos->where('tipo', 1)->first()->speech_id_hijo)
                                ->where('OS.tipo', 1)
                                ->first();
        }
        else
        {
            $bienvenida = '';
        }


        $grupo = $campana->Grupos->first();
        /**
         * Obtenemos el histórico de llamadas de cliente
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

       return view('agentes::show', compact( 'campana', 'calledid', 'historico', 'grupo', 'canal', 'uniqueid', 'speech', 'campos', 'bienvenida'));
    }
    /**
     * Funcion para colgar llamada
     * Esta funcion sirve para colgar solo la llamada,
     * esto desde el boton de colgar en la pantalla del agente
     */
    public function colgar( Request $request )
    {
        $agente = auth()->guard('agentes')->user();
        /**
         * Generamos un evento para colgar la llamada
         */
        EventosAmiController::colgar_llamada( $request->canal, $agente->Empresas_id );
    }
    /**
     * Funcion para poner como no disponible a un agente
     */
    public function no_disponible( Request $request )
    {
        $agente = auth()->guard('agentes')->user();

        EventosAgenteController::no_disponible( $agente->id, $agente->Empresas_id );
        /**
         * Registramos el evento de no disponible del agente
         */
        $evento = LogRegistroEventosController::registro_evento( auth()->guard('agentes')->id(), $request->no_disponible );

        return view('agentes::cronometro', compact( 'agente', 'evento' ));
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public function agente_disponible( Request $request )
    {
        $agente = auth()->guard('agentes')->user();
        EventosAgenteController::agente_disponible( $request, $agente->id, $agente->Empresas_id );
    }
    /**
     * Funcion para mostrar el historial de llamadas contestadas
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
     * Funcion para mostrar el historial de llamadas contestadas
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
     * Funcion para poner como  disponible a un agente
     */
    public function logeoExtension()
    {
        $agente = auth()->guard('agentes')->user();
        return EventosAgenteController::logeoExtension( $agente );
    }
}
