<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;
use DB;
use nusoap_client;

use Nimbus\Miembros_Campana;
use Nimbus\Agentes;

class EventosAgenteController extends Controller
{
    /**
     * Funcion para colgar llamada
     */
    public function colgar( Request $request )
    {
        EventosAmiController::colgar_llamada( $request->canal );
    }
    /**
     * Funcion para poner como no disponible a un agente
     */
    public function no_disponible( Request $request )
    {
        $evento = LogRegistroEventosController::registro_evento( auth()->guard('agentes')->id(), $request->no_disponible );
        Miembros_Campana::where( 'membername', auth()->guard('agentes')->id() )->update(['Paused' => 1]);
        Agentes::where( 'id', auth()->guard('agentes')->id() )->update(['Cat_Estado_Agente_id' => 3]);

        $agente = auth()->guard('agentes')->id();

        return view('agentes::cronometro', compact( 'agente', 'evento' ));
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public function agente_disponible( Request $request )
    {
        LogRegistroEventosController::actualiza_evento( $request->agente, $request->evento );
        Miembros_Campana::where( 'membername', $request->agente )->update(['Paused' => 0]);
        Agentes::where( 'id', $request->agente )->update(['Cat_Estado_Agente_id' => 2]);

    }
    /**
     * Funcion para mostrar el historial de llamadas contestadas
     */
    public function historial_llamadas( Request $request )
    {
        $historico = DB::table('Cdr_call_center')
                    ->join( 'Cdr_call_center_detalles', 'Cdr_call_center.uniqueid', '=', 'Cdr_call_center_detalles.uniqueid' )
                    ->join( 'Cdr_Asignacion_Agente', 'Cdr_call_center_detalles.uniqueid', '=', 'Cdr_Asignacion_Agente.uniqueid' )
                    ->join( 'Agentes', 'Cdr_Asignacion_Agente.Agentes_id', '=', 'Agentes.id' )
                    ->select(
                                'Cdr_call_center.uniqueid',
                                'Cdr_call_center.tipo',
                                'Cdr_call_center.calledid',
                                'Cdr_call_center.fecha_inicio',
                                'Cdr_call_center.fecha_fin',
                                DB::raw("IF(Cdr_call_center_detalles.aplicacion='Campana','', (SELECT Campanas.nombre FROM Campanas WHERE Campanas.id = Cdr_call_center_detalles.id_aplicacion)) AS campana")
                            )
                    ->where('Cdr_Asignacion_Agente.Agentes_id', $request->id_agente)
                    ->whereDate('Cdr_call_center.fecha_inicio', DB::raw('curdate()'))
                    ->orderByRaw( 'Cdr_call_center.fecha_inicio, Cdr_call_center.tipo DESC' )->get();

        $inbound = $historico->where('tipo', 'Inbound')->sortByDesc('fecha_inicio');
        $outbound = $historico->where('tipo', 'Outbound')->sortByDesc('fecha_inicio');
        $manual = $historico->where('tipo', 'Manual')->sortByDesc('fecha_inicio');

        return view('agentes::historial_llamadas', compact( 'inbound', 'outbound', 'manual' ) );
    }
    /**
     * Funcion para mostrar el historial de llamadas abandonadas
     */
    public function llamadas_abandonadas( Request $request )
    {
        $historico = DB::table('Cdr_call_center')
                    ->join( 'Cdr_call_center_detalles', 'Cdr_call_center.uniqueid', '=', 'Cdr_call_center_detalles.uniqueid' )
                    ->select(
                                'Cdr_call_center.uniqueid',
                                'Cdr_call_center.tipo',
                                'Cdr_call_center.calledid',
                                'Cdr_call_center.fecha_inicio',
                                'Cdr_call_center.fecha_fin',
                                'Cdr_call_center.hangup',
                                DB::raw("IF(Cdr_call_center_detalles.aplicacion='Campana','', (SELECT Campanas.nombre FROM Campanas WHERE Campanas.id = Cdr_call_center_detalles.id_aplicacion)) AS campana")
                            )
                    ->where('Cdr_call_center.hangup', 'ABANDON')
                    ->where('Cdr_call_center_detalles.aplicacion', 'Campanas')
                    ->whereIn('Cdr_call_center_detalles.id_aplicacion', [ DB::raw('select Miembros_Campanas.queue_name from Miembros_Campanas where membername =' .$request->id_agente) ] )
                    ->whereDate('Cdr_call_center.fecha_inicio', DB::raw('curdate()'))->get();

        $inbound = $historico->where('tipo', 'Inbound')->sortByDesc('fecha_inicio');
        $outbound = $historico->where('tipo', 'Outbound')->sortByDesc('fecha_inicio');
        $manual = $historico->where('tipo', 'Manual')->sortByDesc('fecha_inicio');

        return view('agentes::llamadas_abandonadas', compact( 'inbound', 'outbound', 'manual' ) );
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public function logeoExtension( Request $request )
    {
        $wsdl = 'http://10.255.242.136/ws-ms/index.php';


        $client =  new  nusoap_client( $wsdl );

        $result = $client->call('LogueoExtension', array(
            'empresas_id' => 24,
            'agentes_id' => 8,
            'canal' => 'CANAL',
            'extension' => '11536501002'
    ));

        /*$cliente =  new  SoapClient( $wsdl, ['encoding' => 'UTF-8','trace' => true] );

        $param = array(
                        'empresas_id' => $request->id_empresa,
                        'agentes_id' => $request->idAgente,
                        'canal' => $request->canal,
                        'extension' => $request->extension
                    );

        $resultado = $cliente->LogueoExtension( $param );
                    */
        return json_encode($result);

    }
}
