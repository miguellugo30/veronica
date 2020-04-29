<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Routing\Controller;
use PHPAMI\Ami;

use Nimbus\Empresas;

class EventosAmiController extends Controller
{
    private $pbx;
    /**
     * Constructor para obtener el PBX de una empresa
     */
    public function __construct( $empresa_id )
    {
        $this->pbx = Empresas::empresa( $empresa_id )->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
    }

    private function conectarAmi()
    {
        $ami = new Ami();
        if ($ami->connect($this->pbx->Config_Empresas->ms->ip_pbx.':5038', $this->pbx->Config_Empresas->usuario_ami, $this->pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        return $ami;
    }

    public function colgar_llamada( $canal )
    {
        $result = $this->conectarAmi()->command('hangup request '.$canal);
        $this->conectarAmi()->disconnect();
        return $result;
    }

    public function despausar_agente( $interface, $accion )
    {
        $result = $this->conectarAmi()->command('queue '.$accion.' member '.$interface);
        $this->conectarAmi()->disconnect();
        return $result;
    }

    public function redirect_monitoreo( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,monitorea,1');
        $this->conectarAmi()->disconnect();
        return $result;
    }

    public function redirect_monitoreo_espera( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,s,11');
        $this->conectarAmi()->disconnect();
        return $result;
    }

    public function redirect_coaching( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,couchea,1');
        $this->conectarAmi()->disconnect();
        return $result;
    }

    public function redirect_conferencia( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,wisper,1');
        $this->conectarAmi()->disconnect();
        return $result;
    }

    public function redirect_transferencia( $canal, $contexto, $extension, $id_destino, $destino, $contexto_hijo )
    {

        if ( $destino == 'Cat_Extensiones' )
        {
            $this->conectarAmi()->setVar($canal, 'ID_AGENTE', $id_destino);
        }
        else
        {
            $this->conectarAmi()->setVar($canal, 'DEST', $destino);
            $this->conectarAmi()->setVar($canal, 'APLI_ID', $id_destino);
            $this->conectarAmi()->setVar($canal, 'CONTEXTO', $contexto_hijo);
        }
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' '.$contexto.','.$extension.',1');
        $this->conectarAmi()->disconnect();
        return $result;
    }
}
