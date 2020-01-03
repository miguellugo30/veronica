<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Routing\Controller;
use PHPAMI\Ami;

use Nimbus\Empresas;

class EventosAmiController extends Controller
{
    public static function colgar_llamada( $canal, $empresas_id )
    {
        $pbx = Empresas::empresa($empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $result = $ami->command('hangup request '.$canal);
        $ami->disconnect();
        return $result;

    }

    public static function despausar_agente( $interface, $accion )
    {
        $agente = auth()->guard('agentes')->user();
        $pbx = Empresas::empresa($agente->Empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $result = $ami->command('queue '.$accion.' member '.$interface);
        return $result;

        $ami->disconnect();
    }

    public static function redirect_monitoreo( $canal, $empresas_id )
    {
        $pbx = Empresas::empresa($empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $result = $ami->command('channel redirect '.$canal.' espera_monitoreo,monitorea,1');
        return $result;

        $ami->disconnect();
    }

    public static function redirect_monitoreo_espera( $canal, $empresas_id )
    {
        $pbx = Empresas::empresa($empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $result = $ami->command('channel redirect '.$canal.' espera_monitoreo,s,11');
        return $result;

        $ami->disconnect();
    }

    public static function redirect_coaching( $canal, $empresas_id )
    {
        $pbx = Empresas::empresa($empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $result = $ami->command('channel redirect '.$canal.' espera_monitoreo,couchea,1');
        return $result;

        $ami->disconnect();
    }

    public static function redirect_conferencia( $canal, $empresas_id )
    {
        $pbx = Empresas::empresa($empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $result = $ami->command('channel redirect '.$canal.' espera_monitoreo,wisper,1');
        return $result;

        $ami->disconnect();
    }
}
