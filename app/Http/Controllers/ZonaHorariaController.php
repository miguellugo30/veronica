<?php

namespace Nimbus\Http\Controllers;

use DB;
use nusoap_client;
use Nimbus\Agentes;
use Nimbus\Empresas;

class ZonaHorariaController extends Controller
{
    /**
     * Zona horaria por empresa
     */
    public function zona_horaria( $empresa_id = NULL, $agente = NULL )
    {

        /**
         * Obtenemos la empresa del agente
         */
        if ( $agente != NULL ) {
             $empresa_id = Agentes::select('Empresas_id')->where('id', $agente)->first();
             $empresa_id = $empresa_id->Empresas_id;
            }
        /**
         * Obtenemos la zona horaria de la empresa
         */
         $zona = DB::select("CALL SP_Obten_Zona_Horaria( NULL ,".$empresa_id.")");
        /**
         * Consumimos el servicio WS, para obtener la fecha y hora del Media Sever
         */
        $pbx = Empresas::empresa( $empresa_id )->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );

        $result = $client->call('TimeMs', array(
            'timeZona' => $zona[0]->zona_horaria
        ));
        /**
         * Retornamos la fecha y hora
         */
        return $result['mensaje'];
    }
}
