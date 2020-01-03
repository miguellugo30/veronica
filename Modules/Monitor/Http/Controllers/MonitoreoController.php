<?php

namespace Modules\Monitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use nusoap_client;
use DB;
use Modules\Agentes\Http\Controllers\EventosAmiController;

use Nimbus\Agentes;
use Nimbus\Grupos;
use Nimbus\Empresas;
use Nimbus\Monitoreo;

class MonitoreoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
        * Sacamos los datos del agente y su empresa para obtener los agentes
        */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $grupos = Grupos::empresa($empresa_id)->active()->where('tipo_grupo', 'Agentes')->get();

        return view('monitor::monitoreo.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('monitor::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $tiempo = NULL;
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $data = array();
        $agente = Agentes::active()->where('id',$request->id)->get()->first();
        /**
         * Validamos si el agente tiene una llamada o no
         * Si tiene llamada se valida si esta, cumple con el tiempo
         * de monitoreo de llamada mayores a cierto tiempo
         */
        if ( $agente->Cat_Estado_Agente_id == 4 || $agente->Cat_Estado_Agente_id == 8 )
        {
            $tiempo = DB::table('Cdr_call_center')
                        ->join( 'Cdr_Asignacion_Agente', 'Cdr_call_center.uniqueid', '=', 'Cdr_Asignacion_Agente.uniqueid' )
                        ->select(
                                    DB::raw('TIME_TO_SEC( TIMEDIFF( NOW(), Cdr_Asignacion_Agente.fecha_respuesta ) ) AS tiempo_llamada'),
                                    'Cdr_Asignacion_Agente.canal'
                                )
                        ->where('Cdr_Asignacion_Agente.Agentes_id', $request->id)
                        ->where('Cdr_call_center.fecha_fin', '0000-00-00 00:00:00')
                        ->orderByRaw('Cdr_Asignacion_Agente.id DESC')
                        ->first();
        }
        else
        {
            $data['status'] = 0;

        }

        if ( $tiempo != NULL ) {

            if ( $tiempo->tiempo_llamada > $request->llamadas_mayores  )
            {
                $llamada = Monitoreo::where([ ['Empresas_id', '=', $empresa_id],['destino', '=', $request->num_monitoreo] ])->orderByRaw('id DESC')->first();

                if ( $llamada->canal_monitorea == NULL )
                {
                    /**
                     * Obtenemos el canal del agente ha monitorear
                     */
                    Monitoreo::where('empresas_id', $empresa_id)
                            ->where('destino', $request->num_monitoreo)
                            ->update(['canal_monitorea' => $tiempo->canal]);


                    EventosAmiController::redirect_monitoreo( $llamada->canal, $empresa_id );
                }

                $data['status'] = 1;
            }
            else
            {
                $data['status'] = 0;
            }
        }
        else
        {
            $data['status'] = 0;
        }

        return json_encode( $data );
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        if( $id == 0 )
        {
            $agentes = Agentes::empresa( $empresa_id )->active()->get();
        }
        else
        {
            $grupo = Grupos::active()->where('id', $id)->with(['Agentes'=> function ($query){
                    $query->where('activo', 1);
            }])->first();
            $agentes = $grupo->Agentes;
        }

        return view('monitor::monitoreo.show', compact('agentes', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $llamada = Monitoreo::where([ ['Empresas_id', '=', $empresa_id],['destino', '=', $id] ])->orderByRaw('id DESC')->first();

        if ( $llamada->canal != NULL )
        {
            $data = EventosAmiController::redirect_monitoreo_espera( $llamada->canal, $empresa_id );
            $llamada->canal_monitorea = NULL;
            $llamada->save();
        }

        return $data;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Creamos una petición, para poder escribir
         * generar la llamada para poder monitorear
         **/
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );
        $result = $client->call('Llamada_Monitoreo', array('empresas_id' => $empresa_id, 'extension' => $request->num_monitoreo));

        if ( $result['error']  == 1 )
        {
                $data['status'] = 1;
                $data['estado'] = $result['mensaje'];
                return json_encode( $data );
        }
        else
        {
            $data['status'] = 0;
            $data['estado'] = $result['mensaje'];
            return json_encode( $data );
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        /**
         * Colgamos la llamada de monitoreo
         */
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $llamada = Monitoreo::where([ ['Empresas_id', '=', $empresa_id],['destino', '=', $request->num_monitoreo] ])->get();

        if ( $llamada->isNotEmpty() )
        {
            EventosAmiController::colgar_llamada( $llamada[0]->canal, $empresa_id );
        }

    }
    /**
     * Funcion para saber si se establecio la llamada con
     * la cual se va ha monitorear
     */
    public function LlamadaEstablecida(Request $request)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $llamada = Monitoreo::where([ ['Empresas_id', '=', $empresa_id],['destino', '=', $request->num_monitoreo] ])->get();

        if ( $llamada->isNotEmpty() )
        {
            $data['status'] = 1;
            $data['estado'] = "Se ha establecido la llamada de monitoreo.";
            return json_encode( $data );
        }
        else
        {
            $data['status'] = 0;
            $data['estado'] = "No se puede establecer la llamada de monitoreo.";
            return json_encode( $data );
        }
    }
    /**
     * Funcion para realizar un coaching de llamada
     */
    public function Llamada_coaching(Request $request)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         **/
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $llamada = Monitoreo::where([ ['Empresas_id', '=', $empresa_id],['destino', '=', $request->num_monitoreo] ])->orderByRaw('id DESC')->first();

        if ( $llamada->canal_monitorea != NULL )
        {
            $data = EventosAmiController::redirect_coaching( $llamada->canal, $empresa_id );
        }

        return $data;

    }
    /**
     * Funcion para realizar un conferencia de llamada
     */
    public function Llamada_conferencia(Request $request)
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         **/
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $llamada = Monitoreo::where([ ['Empresas_id', '=', $empresa_id],['destino', '=', $request->num_monitoreo] ])->orderByRaw('id DESC')->first();

        if ( $llamada->canal_monitorea != NULL )
        {
            $data =  EventosAmiController::redirect_conferencia( $llamada->canal, $empresa_id );
        }
        return $data;
    }
}
