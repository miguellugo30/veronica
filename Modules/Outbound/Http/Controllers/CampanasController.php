<?php

namespace Modules\Outbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\conexionWSController;
use DB;

use App\User;
use App\Http\Controllers\LogController;
use App\Campanas;
use App\Audios_Empresa;
use App\Campanas_Configuracion;
use App\Agentes;
use App\Miembros_Campana;
use App\Speech;
use App\Grupos;
use App\Bases_Datos;
use App\Dids;
use App\Cat_Estado_Cliente;

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
        $campanas = Campanas::empresa($empresa_id)
                    ->tipo('Outbound')
                    ->active()
                    ->with('Campanas_Configuracion')
                    ->with('Estado_Campanas')
                    ->get();

        return view('outbound::Campanas.index', compact('campanas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find(Auth::id());
        $empresa_id = $user->id_cliente;

        $calificaciones = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Calificaciones']])->get();
        $Audios = Audios_Empresa::active()->where([['Empresas_id', $empresa_id], ['musica_en_espera', '=', '0'],])->get();
        $agentes = Agentes::active()->where('Empresas_id', $empresa_id)->get();
        $speech = speech::active()->where('Empresas_id', $empresa_id)->get();
        $bd = Bases_Datos::active()->empresa($empresa_id)->get();
        $dids = Dids::active()->empresa($empresa_id)->get();

        return view('outbound::Campanas.create', compact('Audios', 'agentes', 'speech', 'bd', 'dids', 'calificaciones'));
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
                'id_grabacion' =>  $request->input('msginical'),
                'tipo_marcacion' => 'Outbound',
                'speech_id' =>  $request->input('script'),
                'Base_Datos_id' =>  $request->input('bd'),
                'Grupos_id' =>  $request->input('calificacion'),
                'llamada_agente' =>  $request->input('llamadas_agente'),
                'no_intentos' =>  $request->input('no_intentos'),
                'modalidad_marcado' =>  $request->input('strategy'),
                'Empresas_id'   => $empresa_id,
            ]
        );
        /**
         * Insertar información el tabla de Campanas_Configuracion
         */
        if ( $request->input('strategy') == 'predictivo' ) {
            Campanas_Configuracion::create(
                [
                    'name' =>  $campana->id,
                    'wrapuptime' => $request->input('wrapuptime'),
                    'Campanas_id'   => $campana->id
                ]
            );
        }
        /**
         * Relacionamos los DID con la campana
         */
        $campana->Did()->attach($request->dids, ['activo' => 1]);
        /**
         * Relacionamos la Campana con Estado de Campana ( Pendiente )
         */
        $campana->Estado_Campanas()->attach( 1,['activo' => 1]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, información capturada:' . var_export($request->all(), true);
        $log = new LogController;
        $log->store('Inserción', 'Campana', $mensaje, $user->id);

        return redirect()->route('campanas.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        $campana = Campanas::where( 'id', $id )
                            ->tipo('Outbound')
                            ->with('Campanas_Configuracion')
                            ->with('Estado_Campanas')
                            ->with('Grupos')
                            ->first();

        $estado_cliente = Cat_Estado_Cliente::get();

        return view('outbound::campanas.show', compact('campana', 'estado_cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $campana = Campanas::where('id',$id)->first();

        $user = User::find(Auth::id());
        $empresa_id = $user->id_cliente;

        $calificaciones = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Calificaciones']])->get();
        $Audios = Audios_Empresa::active()->where([['Empresas_id', $empresa_id], ['musica_en_espera', '=', '0'],])->get();
        $agentes = Agentes::active()->where('Empresas_id', $empresa_id)->get();
        $agentesCampana = Miembros_Campana::where('Campanas_id', $id )->get();
        $idAgentesCampana = $agentesCampana->pluck('Agentes_id')->toArray();
        $speech = speech::active()->where('Empresas_id', $empresa_id)->get();
        $bd = Bases_Datos::active()->empresa($empresa_id)->get();
        $dids = Dids::active()->empresa($empresa_id)->get();
        $dids_campana = $campana->Did->map->only(['did']);

        return view('outbound::Campanas.edit', compact( 'campana', 'Audios', 'agentes', 'speech', 'bd', 'dids', 'calificaciones', 'dids_campana', 'idAgentesCampana', 'agentesCampana'));

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
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el tabla de Camapana
         */
        Campanas::where('id', $id)->update(
            [
                'nombre' => $request->input('nombre'),
                'modalidad_logue' => $request->input('mlogeo'),
                'id_grabacion' =>  $request->input('msginical'),
                'tipo_marcacion' => 'Outbound',
                'speech_id' =>  $request->input('script'),
                'Base_Datos_id' =>  $request->input('bd'),
                'fk_calificaciones_id' =>  $request->input('calificacion'),
                'llamada_agente' =>  $request->input('llamadas_agente'),
                'no_intentos' =>  $request->input('no_intentos'),
                'modalidad_marcado' =>  $request->input('strategy'),
                'Empresas_id'   => $empresa_id,
            ]
        );
        /**
         * Insertar información el tabla de Campanas_Configuracion
         */
        if ( $request->input('strategy') == 'predictivo' ) {
            Campanas_Configuracion::where('Campanas_id', $id)->update(
                [
                    'wrapuptime' => $request->input('wrapuptime')
                ]
            );
        }
        /**
         * Relacionamos los DID con la campana
         */
        $campana = Campanas::find($id);
        $campana->Did()->detach();
        $campana->Did()->attach($request->dids, ['activo' => 1]);
        /*
         * Eliminados todos los agentes asocioados a la campana
         * para posteriormente asocociar a los nuevos
         *
        Miembros_Campana::where('Campanas_id', '=', $id)->delete();
         /*
         * Obtenemos la intecace a usar para el agente
         *
        $interface = $this->modalidad_logueo( $request->input('mlogeo') );
        /*
         * Insertar información el tabla de Miembros_Campana
         *
        $agentesParticipantes = json_decode( $request->input('agentesParticipantes') );

        for ($i=0; $i < count($agentesParticipantes); $i++) {
            /*
             * Obtenemos el estado actual ( Pause ) del agente
             *
            $estado = $this->estado_agente( $agentesParticipantes[$i] );
            /*
             * Si la modalidad de logueo es canal cerrado, obtenemos la extension de los agentes
             *
            $extension = $agentesParticipantes[$i];
            if ( $request->input('mlogeo') == 'canal_cerrado' ) {
                $c = Agentes::select('extension')->where('id', $agentesParticipantes[$i] )->first();
                $extension = $c->extension;
            }

            Miembros_Campana::create(
                [
                    'membername' =>  $agentesParticipantes[$i],
                    //'queue_name' => $id,
                    'interface' => $interface.$extension,
                    'paused' => $estado,
                    'Agentes_id' =>  $agentesParticipantes[$i],
                    'Campanas_id'   => $id
                ]
            );
        }
        */
        return redirect()->route('campanas.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Iniciar Campaña en el MS
     *
     * @param Request $request
     * @return void
     */
    public function iniciar_campana(Request $request)
    {
        /**
         * Obtenemos la campana a usar
         */
        $campana = Campanas::where( 'id', $request->campana_id )
                            ->active()
                            ->with('Base_Datos')
                            ->first();

        if( $campana->modalidad_marcado == 'predictivo'  )
        {
            $marcador = 1;
        }
        else
        {
            $marcador = 2;
        }

        $c = new conexionWSController;
        $client = $c->conexionWS();

        $result = $client->call('iniciarDetenerCampana', array(
            'opcion' => 1,
            'empresas_id' => $campana->Empresas_id,
            'campana' => $request->campana_id,
            'marcador' => $marcador,
            'plantilla_id' => $campana->Base_Datos->fk_cat_plantilla_id,
            'base_datos_id' => $campana->Base_Datos_id,
            'llamada_agente' => $campana->llamada_agente,
        ));
        /**
         * Si la respuesta es Iniciada, cambiamos el estado
         */
        if ($result['mensaje'] == 'Iniciada')
        {
            \DB::table('Campanas_activas')
                ->where('fk_campanas', $request->campana_id)
                ->update(['activo' => 0]);

            $campana->Estado_Campanas()->attach( 2,['activo' => 1]);

        }
    }
    /**
     * Iniciar Campaña en el MS
     *
     * @param Request $request
     * @return void
     */
    public function detener_campana(Request $request)
    {
        /**
         * Obtenemos la campana a usar
         */
        $campana = Campanas::where( 'id', $request->campana_id )
                            ->active()
                            ->with('Base_Datos')
                            ->first();

        if( $campana->modalidad_marcado == 'predictivo'  )
        {
            $marcador = 1;
        }
        else
        {
            $marcador = 2;
        }

        $c = new conexionWSController;
        $client = $c->conexionWS();

        $result = $client->call('iniciarDetenerCampana', array(
            'opcion' => 2,
            'empresas_id' => $campana->Empresas_id,
            'campana' => $request->campana_id,
            'marcador' => $marcador,
            'plantilla_id' => $campana->Base_Datos->fk_cat_plantilla_id,
            'base_datos_id' => $campana->Base_Datos_id,
            'llamada_agente' => $campana->llamada_agente,
        ));
        print_r( $result );

        /**
         * Si la respuesta es Iniciada, cambiamos el estado
         */
        if ($result['mensaje'] == 'Detenida')
        {
            \DB::table('Campanas_activas')
                ->where('fk_campanas', $request->campana_id)
                ->update(['activo' => 0]);

            $campana->Estado_Campanas()->attach( 3,['activo' => 1]);

        }
    }
    /**
     * Fucion para obtener la modalidad de logueo donde pertenece un agente
     */
    public function validar_modo_logueo(Request $request)
    {
        /**
         * Borramos todos los miembros que se encuentran en la tabla Miembros_Campana para que nos permita agregar los agentes seleccionados
         */
        Miembros_Campana::whereIn('Agentes_id', $request->idAgente)->delete();
        /**
         * Obtenemos el ultimo id insertado de las campañas
         */
        $Campana_id = Campanas::orderBy('id', 'DESC')->pluck('id')->first();
        /**
         * Iteramos los id's de los agentes para posteriormente sean creados en la tabla Miembros_Campana
         */
        foreach ($request->idAgente as $key) {
            Miembros_Campana::create(
                [
                    'membername' => $key,
                    'Agentes_id' => $key,
                    'Campanas_id' => $Campana_id
                ]
            );
        }
        $idAgente = implode(",", $request->idAgente);
        $modalidad = DB::select("call SP_Modalidad_logeos('$idAgente')");

        return $modalidad;
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
            return 0;
        }
    }
}
