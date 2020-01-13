<?php

namespace Modules\Agentes\Http\Controllers;

use DB;
use nusoap_client;
use Illuminate\Routing\Controller;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;

use Nimbus\Miembros_Campana;
use Nimbus\Agentes;
use Nimbus\Empresas;
use Nimbus\Crd_Asignacion_Agente;

class EventosAgenteController extends Controller
{
    /**
     * Funcion para poner como no disponible a un agente
     */
    public static function no_disponible( $agente, $empresas_id )
    {
        /**
         * Obtenemos el ultimo canal del agenete
         */
        $cdr = Crd_Asignacion_Agente::where('Agentes_id', $agente)->orderBy('id', 'desc')->first();
        /**
         * Pausamos al agente dentro de la campana en BD
         */
        Miembros_Campana::where( 'membername', $agente )->update(['Paused' => 1]);
        /**
         * Pausamos al agente dentro del MS
         */
        $pausa = EventosAmiController::despausar_agente( $cdr->canal, 'pause', $empresas_id );
        //dd( $pausa );
        /**
         * Ponemos en estado no disponible al agente
         */
        Agentes::where( 'id', $agente )->update(['Cat_Estado_Agente_id' => 3]);
    }
    /**
     * Funcion para poner como no disponible a un agente
     */
    public static function no_disponible_real_time( $agente, $empresas_id )
    {
        /**
         * Obtenemos el ultimo canal del agenete
         */
        $cdr = Crd_Asignacion_Agente::where('Agentes_id', $agente)->orderBy('id', 'desc')->first();
        /**
         * Pausamos al agente dentro del MS
         */
        $pausa = EventosAmiController::despausar_agente( $cdr->canal, 'pause', $empresas_id );
        //dd( $pausa );

    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public static function agente_disponible( $request, $agente, $empresas_id )
    {
        /**
         * Registramos el evento de cuando se puso nuevamente en disponible el agente
         */
        LogRegistroEventosController::actualiza_evento( $agente, $request->evento );
        /**
         * Despausamos al agente dentro de la campana en BD
         */
        Miembros_Campana::where( 'membername', $agente )->update(['Paused' => 0]);
        /**
         * Ponemos en estado disponible al agente
         */
        Agentes::where( 'id', $agente )->update(['Cat_Estado_Agente_id' => 2]);
        /**
         * Obtenemos el ultimo canal del agente
         */
        $cdr = Crd_Asignacion_Agente::where('Agentes_id', $agente)->orderBy('id', 'desc')->first();
        /**
         * Despausamos al agente dentro del MS
         */
        EventosAmiController::despausar_agente( $cdr->canal, 'unpause', $empresas_id );

    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public static function agente_disponible_real_time( $request, $agente, $empresas_id )
    {
        /**
         * Obtenemos el ultimo canal del agente
         */
        $cdr = Crd_Asignacion_Agente::where('Agentes_id', $agente)->orderBy('id', 'desc')->first();
        /**
         * Despausamos al agente dentro del MS
         */
        EventosAmiController::despausar_agente( $cdr->canal, 'unpause', $empresas_id );

    }
    /**
     * Funcion para mostrar el historial de llamadas contestadas
     */
    public static function historial_llamadas( $request )
    {
        /**
         * Obtenenos el historico de llamadas del agente en el dia
         */
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

        return $historico;
    }
    /**
     * Funcion para mostrar el historial de llamadas abandonadas
     */
    public static function llamadas_abandonadas( $request )
    {
        /**
         * Obtenenos el historico de llamadas abandonadas del agente en el dia
         */
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

        return $historico;
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public static function logeoExtension( $agente )
    {
        $pbx = Empresas::empresa($agente->Empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );

        $result = $client->call('LogueoExtension', array(
            'empresas_id' => $agente->Empresas_id,
            'agentes_id' => $agente->id,
            'canal' => 'CANAL',
            'extension' => $agente->extension
        ));
        return json_encode($result);
    }
}
