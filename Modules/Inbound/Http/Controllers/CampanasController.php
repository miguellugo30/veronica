<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

use Nimbus\User;
use Nimbus\Http\Controllers\LogController;
use Nimbus\Campanas;
use Nimbus\Audios_Empresa;
use Nimbus\Campanas_Configuracion;
use Nimbus\Agentes;
use Nimbus\Miembros_Campana;
use Nimbus\Speech;
use Nimbus\Grupos;

class CampanasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $campanas = Campanas::empresa($empresa_id)->active()->with('Campanas_Configuracion')->get();

        return view('inbound::Campanas.index',compact('campanas'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $Audios = Audios_Empresa::active()->where([['Empresas_id',$empresa_id],['musica_en_espera','=','0'],])->get();
        $Mohs= Audios_Empresa::active()->where([['Empresas_id',$empresa_id],['musica_en_espera','=','1'],])->get();
        $agentes = Agentes::active()->where('Empresas_id', $empresa_id)->get();
        $speech = speech::active()->where('Empresas_id',$empresa_id)->get();
        $calificaciones = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Calificaciones']])->get();

        return view('inbound::Campanas.create', compact('Audios','Mohs', 'agentes','speech','calificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el tabla de Camapana
         */
        $campana = Campanas::create(
            [
                'nombre' => $request->input('nombre'),
                'modalidad_logue' => $request->input('mlogeo'),
                'id_grabacion' =>  $request->input('msginical') ,
                'tipo_marcacion' => 'Inbound',
                'speech_id' =>  $request->input('script') ,
                'time_max_sonora' =>  $request->input('alertstll') ,
                'time_max_llamada' =>  $request->input('alertstdll') ,
                'time_liberacion' =>  $request->input('libta') ,
                'Empresas_id'   => $empresa_id,
                'Grupos_id' => $request->input('cal_lib')
            ]
        );
        /**
         * Insertar información el tabla de Campanas_Configuracion
         */
        Campanas_Configuracion::create(
            [
                'name' =>  $campana->id,
                'periodic_announce' => $request->input('periodic_announce'),
                'periodic_announce_frequency' =>  $request->input('periodic_announce_frequency') ,
                'wrapuptime' => $request->input('wrapuptime'),
                'strategy' =>  $request->input('strategy'),
                'Campanas_id'   => $campana->id
            ]
        );
        /**
         * Obtenemos la intecace a usar para el agente
         */
        $interface = $this->modalidad_logueo( $request->input('mlogeo') );
        /**
         * Insertar información el tabla de Miembros_Campana
         */
        $agentesParticipantes = json_decode( $request->input('agentesParticipantes') );
        for ($i=0; $i < count($agentesParticipantes); $i++) {
            /**
             * Obtenemos el estado actual ( Pause ) del agente
             */
            $estado = $this->estado_agente( $agentesParticipantes[$i] );

            Miembros_Campana::create(
                [
                    'membername' =>  $agentesParticipantes[$i],
                    'queue_name' => $campana->id,
                    'interface' => $interface.$agentesParticipantes[$i],
                    'paused' => $estado['paused'],
                    'Agentes_id' =>  $agentesParticipantes[$i],
                    'Campanas_id'   => $campana->id
                ]
            );
        }
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Campana',$mensaje, $user->id);

        return redirect()->route('campanas.index');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::Campanas.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $campana= Campanas::where('id',$id)->first();
        $user = Auth::user();;
        $empresa_id = $user->id_cliente;

        $Audios = Audios_Empresa::active()->where([['Empresas_id',$empresa_id],['musica_en_espera','=','0'],])->get();
        $agentesCampana = Miembros_Campana::where('Campanas_id', $id )->get();
        $agentes = Agentes::active()->where('Empresas_id', $empresa_id)->get();
        $idAgentesCampana = $agentesCampana->pluck('Agentes_id')->toArray();
        $speech = speech::active()->where('Empresas_id',$empresa_id)->get();
        $calificaciones = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Calificaciones']])->get();

        return view('inbound::Campanas.edit',compact('campana','Audios', 'agentes', 'agentesCampana', 'idAgentesCampana', 'speech', 'calificaciones'));
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
         * Obtenemos los datos del usuario logeado
         */
        $user = Auth::user();;

        Campanas::where('id', $id)->update([
                                            'nombre' => $request->input('nombre'),
                                            'modalidad_logue' => $request->input('mlogeo'),
                                            'id_grabacion' =>  $request->input('msginical') ,
                                            'tipo_marcacion' => 'Inbound',
                                            'speech_id' =>  $request->input('script') ,
                                            'time_max_sonora' =>  $request->input('alertstll') ,
                                            'time_max_llamada' =>  $request->input('alertstdll') ,
                                            'time_liberacion' =>  $request->input('libta'),
                                            'Grupos_id' => $request->input('cal_lib')
                                        ]);

        Campanas_Configuracion::where('Campanas_id', $id)->update([
                                            'periodic_announce' => $request->input('periodic_announce'),
                                            'periodic_announce_frequency' =>  $request->input('periodic_announce_frequency') ,
                                            'wrapuptime' => $request->input('wrapuptime'),
                                            'strategy' =>  $request->input('strategy')
                                        ]);
        /**
         * Eliminados todos los agentes asocioados a la campana
         * para posteriormente asocociar a los nuevos
         */
        Miembros_Campana::where('Campanas_id', '=', $id)->delete();
         /**
         * Obtenemos la intecace a usar para el agente
         */
        $interface = $this->modalidad_logueo( $request->input('mlogeo') );
        /**
         * Insertar información el tabla de Miembros_Campana
         */
        $agentesParticipantes = json_decode( $request->input('agentesParticipantes') );
        for ($i=0; $i < count($agentesParticipantes); $i++) {
            /**
             * Obtenemos el estado actual ( Pause ) del agente
             */
            $estado = $this->estado_agente( $agentesParticipantes[$i] );

            Miembros_Campana::create(
                [
                    'membername' =>  $agentesParticipantes[$i],
                    'queue_name' => $id,
                    'interface' => $interface.$agentesParticipantes[$i],
                    'paused' => $estado,
                    'Agentes_id' =>  $agentesParticipantes[$i],
                    'Campanas_id'   => $id
                ]
            );
        }

        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un actualizo registro, informacion actualizada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Camapanas',$mensaje, $user->id);

        return redirect()->route('campanas.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    /**
     * Evento para eliminar una campana
     */
    public function destroy($id)
    {
        Campanas::where('id',$id)
        ->update(['activo'=>'0']);

        Miembros_Campana::where('queue_name', $id)->delete();
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Campanas', $mensaje, $id);

        return redirect()->route('campanas.index');
    }
    /**
     * Fucion para obtener la modalidad de logueo donde pertenece un agente
     */
    public function validar_modo_logueo( Request $request )
    {
        $modalidad = DB::table('Miembros_Campanas')
                    ->join( 'Campanas', 'Campanas.id', '=', 'Miembros_Campanas.Campanas_id' )
                    ->select(
                                'Campanas.modalidad_logue'
                            )
                    ->where('Miembros_Campanas.Agentes_id', $request->idAgente)
                    ->where('Campanas.activo', 1)->get();

        return $modalidad;
    }
    /**
     * Funcion para eliminar agentes participante de una campana
     */
    public function eliminar_participantes( Request $request )
    {
        Miembros_Campana::where('queue_name', $request->camapana_id)->delete();
    }
    /**
     * Funcion para definir la interface del agente con base a
     * la modalidad de logueo
     */
    public function modalidad_logueo( $modalidad )
    {
        /**
         * Definir la interface, dependiendo la modalidad de logueo
         */
        if ( $modalidad == 'canal_abierto' ) {
            return 'Agent/';
        } else {
            return 'SIP/';
        }
    }
    /**
     * Funcion para devolver el estado del agente,
     * si no se encuentra el agente regresa el estado
     * en pausa = 1, si no se regresa el estado actual
     */
    public function estado_agente( $agente )
    {
        $estado = Miembros_Campana::select('paused')->where('Agentes_id', $agente)->groupBy('paused')->get();

        if ($estado == '') {
            return 1;
        } else {
            return $estado[0]->paused;
        }
    }

}
