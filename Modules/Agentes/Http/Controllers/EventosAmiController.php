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
    /**
     * Funcion para hacer la conexion al AMI de Asterisk
     */
    private function conectarAmi()
    {
        $ami = new Ami();
        if ($ami->connect($this->pbx->Config_Empresas->ms->ip_pbx.':5038', $this->pbx->Config_Empresas->usuario_ami, $this->pbx->Config_Empresas->clave_ami, 'off') === false)
        {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        return $ami;
    }
    /**
     * Funcion para colgar la llamada
     */
    public function colgar_llamada( $canal )
    {
        $result = $this->conectarAmi()->hangup($canal);
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     * Funcion para pausar/despausar el agente
     */
    public function despausar_agente( $interface, $accion )
    {
        $result = $this->conectarAmi()->command('queue '.$accion.' member '.$interface);
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     * Funcion para hacer una redirect para monitorear uno o varios agente
     */
    public function redirect_monitoreo( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,monitorea,1');
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     * Funcion para hacer una redirect para monitorear el agente
     */
    public function redirect_monitoreo_espera( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,s,11');
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     *Funcion para hacer una redirect para cochear a el agente
     */
    public function redirect_coaching( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,couchea,1');
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     *Funcion para hacer una redirect para hacer conferencia con el agente
     */
    public function redirect_conferencia( $canal )
    {
        $result = $this->conectarAmi()->command('channel redirect '.$canal.' espera_monitoreo,wisper,1');
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     *Funcion para hacer una redirect para la transferencia de llamada
     * Ya sea a una aplicación o a una extension
     */
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
    /**
     * Funcion para agregar un agente a las diferentes campañas que esta agregado
     */
    public function addMember( $queue, $interface, $agente_id )
    {
        $result = $this->conectarAmi()->queueAdd( $queue, $interface, 1, $agente_id );
        $this->conectarAmi()->disconnect();
        return $result;
    }
    /**
     * Funcion para quitar a un las diferentes campañas que esta agregado
     */
    public function removeMember($queue, $interface)
    {
        $result = $this->conectarAmi()->queueRemove( $queue, $interface, 1 );
        $this->conectarAmi()->disconnect();
        return $result;
    }
}
