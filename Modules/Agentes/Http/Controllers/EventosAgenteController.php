<?php

namespace Modules\Agentes\Http\Controllers;

use DB;
use nusoap_client;
use Illuminate\Routing\Controller;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;
use Nimbus\Http\Controllers\ZonaHorariaController;

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
         * Obtenemos el ultimo canal del agente
         */
        $cdr = Crd_Asignacion_Agente::where('Agentes_id', $agente)->orderBy('id', 'desc')->first();
        /**
         * Pausamos al agente dentro de la campana en BD
         */
        Miembros_Campana::where( 'membername', $agente )->update(['Paused' => 1]);
        /**
         * Pausamos al agente dentro del MS
         */
        //$pausa = EventosAmiController::despausar_agente( $cdr->canal, 'pause', $empresas_id );
        /**
         * Obtenemos la zona horaria de la empresa
         */
        $fecha = ZonaHorariaController::zona_horaria( $empresas_id );
        /**
         * Ponemos al usuario en estado 1 = No Disponible
         */
        DB::select("CALL SP_Actualiza_Estado_Agentes(".$agente.",3,0,'$fecha')");
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
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public static function agente_disponible( $request, $agente, $empresas_id )
    {
        /**
         * Registramos el evento de cuando se puso nuevamente en disponible el agente
         */
        LogRegistroEventosController::actualiza_evento( $agente, $request->evento, 0 );
        /**
         * Despausamos al agente dentro de la campana en BD
         */
        Miembros_Campana::where( 'membername', $agente )->update(['Paused' => 0]);
         /**
         * Obtenemos la zona horaria de la empresa
         */
        $fecha = ZonaHorariaController::zona_horaria( $empresas_id );
        /**
         * Ponemos en estado disponible al agente
         */
        DB::select("CALL SP_Actualiza_Estado_Agentes(".$agente.",2,0,'$fecha')");
        /**
         * Obtenemos el ultimo canal del agente
         */
        $cdr = Crd_Asignacion_Agente::where('Agentes_id', $agente)->orderBy('id', 'desc')->first();
        /**
         * Despausamos al agente dentro del MS
         */
        //EventosAmiController::despausar_agente( $cdr->canal, 'unpause', $empresas_id );
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
        $historico = DB::select( "call SP_Pantalla_agentes($request->id_agente)");

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
        $historico = DB::select( "call SP_Llamadas_abandonadas_agente($request->id_agente)");

        return $historico;
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public static function logeoExtension( $agente )
    {
        $fecha = ZonaHorariaController::zona_horaria_agente( $agente->id );

        $pbx = Empresas::empresa($agente->Empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );

        $result = $client->call('LogueoExtension', array(
            'empresas_id' => $agente->Empresas_id,
            'agentes_id' => $agente->id,
            'canal' => 'CANAL',
            'extension' => $agente->extension
        ));
        /**
         * Si la respuesta es 1, se cambia el estatus a disponible
         */
        if( $result['error'] == 1 )
        {
            /**
             * Ponemos en estado disponible al agente
             */
            DB::select("CALL SP_Actualiza_Estado_Agentes(".$agente->id.",2,0,'$fecha')");
        }
        else
        {
            /**
             * Ponemos en estado logueado al agente
             */
            DB::select("CALL SP_Actualiza_Estado_Agentes(".$agente->id.",11,0,'$fecha')");
        }

        return json_encode($result);
    }
}
