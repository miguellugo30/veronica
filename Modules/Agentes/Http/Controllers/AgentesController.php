<?php

namespace Modules\Agentes\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ZonaHorariaController;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use Modules\Agentes\Http\Controllers\EventosAgenteController;
use Modules\Agentes\Http\Controllers\CalificarLlamadaController;
use App\Agentes;
use App\Did_Enrutamiento;
use App\Campanas;
use App\Cat_Extensiones;
use App\Cdr_call_center;
use App\Cdr_call_center_detalles;
use App\Crd_Asignacion_Agente;
use App\Miembros_Campana;
use App\Eventos_Agentes;
use App\HistorialEventosAgentes;

class AgentesController extends Controller
{

    private $empresa_id;
    private $fecha;
    /**
     * Constructor para obtener el id empresa
     * con base al usuario que esta usando la sesion
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->empresa_id = auth()->guard('agentes')->user()->Empresas_id;

            $e = new ZonaHorariaController();
            $this->fecha = $e->zona_horaria( $this->empresa_id, NULL );

            return $next($request);
        });
    }

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
         * Recuperamos el estado del agente
         */
        $agenteEstado = HistorialEventosAgentes::select('fk_cat_estado_agente_id', 'monitoreo')
                                            ->where('fk_agentes_id',auth()->guard('agentes')->id())
                                            ->orderBy('fecha_registro', 'desc')
                                            ->first();
        /**
         * Obtenemos los datos del agente
         */
        $agente = auth()->guard('agentes')->user();
        /**
         * Obtenemos los eventos por los cuales podrá ser pausado el agente
         */
        $eventosAgente = Eventos_Agentes::active()->where('Empresas_id', $this->empresa_id)->get();
        /**
         * Obtenemos las aplicaciones que estan activas en el MS
         */
        $aplicaciones = Did_Enrutamiento::select('id', 'aplicacion')->active()->where( 'prioridad', 1 )->with(['Did' => function ($query){
                        $query->empresa( $this->empresa_id )->active();
                }])->get();

        return view('agentes::index', compact('agente', 'evento', 'eventosAgente', 'modalidad', 'agenteEstado', 'aplicaciones'));
    }
    /**
     * Función para calificar la llamada
     */
    public function store(Request $request)
    {
        /**
         * Ponemos en estado disponible al agente
         */
        DB::select("CALL SP_Actualiza_Estado_Agentes(".$request->id_agente.",2,0,'".$this->fecha."')");
        /**
         * Dentro de la campana lo ponemos como despausado.
         */
        Miembros_Campana::where( 'membername', $request->id_agente )->update(['Paused' => 0]);
        /**
         * Actualizamos la fecha de calificación.
         */
        Crd_Asignacion_Agente::where('uniqueid', $request->uniqueid)->update(['fecha_calificacion' => $this->fecha]);
        /**
         * Generamos el evento para colgar llamada.
         */
        $e = new EventosAmiController( $this->empresa_id );
        $e->colgar_llamada( $request->canal, $this->empresa_id );
        $e->colgar_llamada( $request->canal_entrante, $this->empresa_id );
        /**
         * Despausamos al agente directamente en el MS.
         */
        $e->despausar_agente( $request->canal, 'unpause' );
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
        $agente = HistorialEventosAgentes::select('fk_cat_estado_agente_id', 'monitoreo')
                                            ->where('fk_agentes_id',$id)
                                            ->orderBy('fecha_registro', 'desc')
                                            ->first();

        $data['monitoreo'] = $agente->monitoreo;
        /**
         * Estado 4 y 8 en llamada
         * Estado 3 en pausa
         */
        if ( $agente->fk_cat_estado_agente_id == 4 || $agente->fk_cat_estado_agente_id == 8 ) {
            $data['status'] = 1;
            $data['estado'] = $agente->Cat_Estado_Agente->nombre;
            return json_encode( $data );
        } else if( $agente->fk_cat_estado_agente_id == 3 ) {
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
        $datos_llamada = Crd_Asignacion_Agente::where( 'Agentes_id', $id )->orderBy('id', 'desc')->limit(1)->first();

	    $cdrDetalle =  Cdr_call_center_detalles::where( 'uniqueid', $datos_llamada->uniqueid )->orderBy('id', 'desc')->first();
	    /**
         * Obtenemos el CALLED y CALLER
         */
        $CDR = Cdr_call_center::where( 'uniqueid', $datos_llamada->uniqueid )->orderBy('id', 'desc')->first();
        $calledid = $CDR->first()->calledid;
        $callerid = $CDR->first()->callerid;
        $canal = $datos_llamada->canal;
        $uniqueid = $datos_llamada->uniqueid;
        /**
         * Obtenemos el canal de llamada entrante
         */
        $canal_entrante = $CDR;
        /**
         * Obtenemos la información de la campana a la cual esta el agente y la llamada
         */

        if ( $cdrDetalle->aplicacion == 'Campanas' ) {
            $campana = Campanas::active()->where( 'id', 6 )->get()->first();
        }
        /**
         * Obtenemos el Speech y el grupo de calificaciones
         */

        $speech = $campana->Speech()->first();

        $campos = $speech->Opciones_Speech()->first();

        if ( $speech->tipo == 'dinamico' )
        {
            $bienvenida = DB::table('Opciones_Speech AS OS')
                                ->join('appLaravel.speech AS S', 'OS.speech_id_hijo', '=', 'S.id')
                                ->select(
                                    'S.texto'
                                )
                                ->where('OS.id', $campos->where('tipo', 1)->first()->id)
                                ->where('OS.tipo', 1)
                                ->first();
        }
        else
        {
            $bienvenida = '';
        }

        $grupo = $campana->Grupos->first();

        //dd($grupo->Calificaciones()->first());
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

       return view('agentes::show', compact( 'campana', 'calledid', 'historico', 'grupo', 'canal', 'uniqueid', 'speech', 'campos', 'bienvenida', 'canal_entrante'));
    }
    /**
     * Funcion para colgar llamada
     * Esta funcion sirve para colgar solo la llamada,
     * esto desde el boton de colgar en la pantalla del agente
     */
    public function colgar( Request $request )
    {
        /**
         * Generamos un evento para colgar la llamada
         */
        $e = new EventosAmiController( $this->empresa_id );
        $e->colgar_llamada( $request->canal );
    }
    /**
     * Funcion para poner como no disponible a un agente
     */
    public function no_disponible( Request $request )
    {
        $agente = auth()->guard('agentes')->user();

        $e = new EventosAgenteController();
        $e->no_disponible( $agente->id, $this->empresa_id );
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
        $e = new EventosAgenteController();
        $e->agente_disponible( $request, $agente->id, $this->empresa_id );
    }
    /**
     * Funcion para mostrar el historial de llamadas contestadas
     */
    public function historial_llamadas( Request $request )
    {
        $e = new EventosAgenteController();
        $historico = $e->historial_llamadas( $request );

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
        $e = new EventosAgenteController();
        $historico = $e->llamadas_abandonadas( $request );

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
        $e = new EventosAgenteController();

        return $e->logeoExtension( $agente );
    }
    /**
     * Funcion para transferir una llamada
     */
    public function transferir_llamada( Request $request )
    {
        $e = new EventosAmiController( $request->id_empresa );

        $destino = $request->destino_transferencia;

        if ( $request->destino_transferencia == 'Cat_Extensiones'  )
        {
            $contexto = 'transferencia_extension';
            $contexto_hijo = '';
            $extensiones = Cat_Extensiones::find( $request->opciones_transferencia );
            $extension = '1153650'.$extensiones->extension;//Extension a donde se transfiere la llamada
            $id_destino = $request->opciones_transferencia;//ID de Extension a donde se transfiere la llamada
            /**
             * Obtenemos el ID del agente que esta usando la extension
             */
            $agente = Agentes::select('id')->where([ 'Empresas_id' => $extensiones->Empresas_id, 'extension_real' => $extension->extension ])->first();
             /**
             * Ponemos en pausa al agente que le vamos a transferir la llamada
             */
            $e->despausar_agente( 'Agent/'.$agente->id, 'pause' );
            DB::select("CALL SP_Actualiza_Estado_Agentes(".$agente->id.",8,0,'".$this->fecha."')");
            /**
             * Ponemos en despausa al agente que hara la transferencia
             */
            $e->despausar_agente( 'Agent/'.$request->idAgente, 'unpause' );
            DB::select("CALL SP_Actualiza_Estado_Agentes(".$request->idAgente.",2,0,'".$this->fecha."')");
        }
        elseif( $request->destino_transferencia == 'Agentes' )
        {
            $contexto = 'transferencia_extension';
            $contexto_hijo = '';
            /**
             * Se recupera el id del agente que tiene en uso la extension
             * a transferir
             */
            $opcionTransferencia = explode( '|', $request->opciones_transferencia );
            $agente = $opcionTransferencia[0];//ID de agente a quien se transfiere la llamada
            $extension = $opcionTransferencia[1];//Extension a donde se transfiere la llamada
            $id_destino = $opcionTransferencia[2];//ID de Extension a donde se transfiere la llamada
            /**
             * Si se encuentra la transferencia de pantalla
             * se hacen las acciones
             */
            if ( $request->transferirPantalla == 1 )
            {
                /**
                 * Actualizamos el registro en CDR Asignacion Agente
                 * para el agente que ahora tendra la llamada
                 */
                Crd_Asignacion_Agente::where(['uniqueid' => $request->uniqueid])->update(['Agentes_id' => $agente, 'canal' => 'Agent/'.$agente]);
            }
            /**
             * Ponemos en pausa al agente que le vamos a transferir la llamada
             */
            $e->despausar_agente( 'Agent/'.$agente, 'pause' );
            DB::select("CALL SP_Actualiza_Estado_Agentes(".$agente.",8,0,'".$this->fecha."')");
            /**
             * Ponemos en despausa al agente que hara la transferencia
             */
            $e->despausar_agente( 'Agent/'.$request->idAgente, 'unpause' );
            DB::select("CALL SP_Actualiza_Estado_Agentes(".$request->idAgente.",2,0,'".$this->fecha."')");
        }
        else
        {
            $v = explode( '|', $request->opciones_transferencia );
            $id_destino = $v[1];
            $contexto = 'transferencia_aplicacion';
            $extension = 's';
            $contexto_hijo = 'Inbound_'.$v[0];
        }

        return $e->redirect_transferencia( $request->canal, $contexto, $extension, $id_destino, $destino, $contexto_hijo );
    }
    /**
     * Funcion para obtener las aplicacion de prioridad 1 que estan configuradas
     * en el MS
     */
    public function AplicacionMS( Request $request )
    {

        $opcion = $request->opcion;

        if ( $opcion == 'Cat_Extensiones' )
        {
            $aplicaciones = Cat_Extensiones::select( 'id', 'extension as nombre' )->active()->where('Empresas_id', $this->empresa_id)->get();
        }
        else if ( $opcion == 'Agentes' )
        {
            //$fecha = ZonaHorariaController::zona_horaria( $this->empresa_id );
            $aplicaciones = DB::select( "call SP_Agentes_Activos_Empresa(".$this->empresa_id.", '".$this->fecha."')");
        }
        else
        {
            $aplicaciones = DB::table('Did_Enrutamiento')
                            ->join( 'Dids', 'Did_Enrutamiento.Dids_id', '=', 'Dids.id' )
                            ->select(
                                'Did_Enrutamiento.id',
                                'Did_Enrutamiento.aplicacion',
                                'Did_Enrutamiento.tabla',
                                'Did_Enrutamiento.tabla_id',
                                DB::raw("(SELECT ".$opcion .".nombre FROM ".$opcion ." WHERE ".$opcion .".id = Did_Enrutamiento.tabla_id) AS nombre")
                            )
                            ->where('Did_Enrutamiento.prioridad', 1)
                            ->where('Did_Enrutamiento.activo', 1)
                            ->where('Did_Enrutamiento.tabla', $opcion)
                            ->where('Dids.empresas_id', $this->empresa_id )->get();
        }
        return view('agentes::show_aplicaciones', compact( 'aplicaciones', 'opcion' ) );

    }
    /**
     * Funcion para generar una conferencia
     */
    public function realizarConferencia(Request $request)
    {
        $e = new EventosAmiController( $request->id_empresa );

    return $e->conferencia($request->canal, $request->canal_entrante, $request->id_empresa);
    }
}
