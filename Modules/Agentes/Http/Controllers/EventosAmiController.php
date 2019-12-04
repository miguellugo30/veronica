<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PHPAMI\Ami;

use Nimbus\Empresas;

class EventosAmiController extends Controller
{
    public static function colgar_llamada( $canal )
    {
        $agente = auth()->guard('agentes')->user();
        $pbx = Empresas::empresa($agente->Empresas_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();

        $ami = new Ami();
        if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $ami->command('hangup request '.$canal);

        $ami->disconnect();
    }
}
