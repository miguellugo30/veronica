<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use nusoap_client;
use Modules\Settings\Http\Requests\AgentesRequest;
use PHPAMI\Ami;

use Nimbus\Agentes;
use Nimbus\Canales;
use Nimbus\Grupos;
use Nimbus\Empresas;
use Nimbus\Cat_Extensiones;
use Nimbus\Perfiles;

class AgentesController extends Controller
{
    private $empresa_id;

    /**
     * Constructor para obtener el id empresa
     * con base al usuario que esta usando la sesion
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->empresa_id = Auth::user()->id_cliente;

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $agentes = Agentes::empresa( $this->empresa_id )->active()->with('Canales')->with('Grupos')->with('Perfiles')->get();
        return view('settings::Agentes.index',compact('agentes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos el id empresa del usuario para obtener los canales
         */


        $empresa = Empresas::find( $this->empresa_id );
        $cat_extensiones = Cat_Extensiones::active()->empresa( $this->empresa_id )->get();
        $canales = Canales::active()->where('Empresas_id', $this->empresa_id)->get();
        $grupos = Grupos::active()->where([['Empresas_id', '=', $this->empresa_id],['tipo_grupo','=','Agentes']])->get();
        $perfiles = Perfiles::active()->empresa( $this->empresa_id )->get();

        return view('settings::Agentes.create', compact('canales', 'grupos', 'empresa', 'cat_extensiones', 'perfiles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(AgentesRequest $request)
    {
        /**
         * Insertamos el nuevo agentes
         */
        $agente = Agentes::create([
                    'nombre' => $request->nombre,
                    'usuario' => $request->usuario,
                    'email' => $request->usuario,
                    'password' => Hash::make( $request->contrasena ),
                    'contrasena' => $request->contrasena,
                    'extension' => $request->extension,
                    'extension_real' => $request->extension,
                    'nivel' => $request->nivel,
                    'tipo_licencia' => $request->tipo_licencia,
                    'Canales_id' => $request->Canales_id,
                    'mix_monitor' => (int)$request->mix_monitor,
                    'id_perfil_marcacion' => (int)$request->perfil,
                    'calificar_llamada' => (int)$request->calificar_llamada,
                    'envio_sms' => (int)$request->envio_sms,
                    'editar_datos' => (int)$request->editar_datos,
                    'Cat_Estado_Agente_id' => 1,
                    'Empresas_id' => $this->empresa_id
        ]);
        /**
         * Buscamos el grupo para poderlo vincular al agente
         */
        if( $request->grupo != 0 )
        {
            $grupo = Grupos::find( $request->grupo );
            $grupo->Agentes()->attach($agente->id);
        }
        /**
         * Creamos una petición, para poder escribir
         * los agentes en el archivo AGENTS.CONF
         */
        $pbx = Empresas::empresa( $this->empresa_id )->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );
        $result = $client->call('AgentesConf', array(
                                                        'empresas_id' => $this->empresa_id
                                                    ));
        /**
         * Si la respuesta es 1, se hace el reload del sip
         */
        if ($result['error'] == 1) {
            $ami = new Ami();
            if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
            {
               throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
            }
            $result  = $ami->command('dialplan Reload');
            $ami->disconnect();
        }
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, información capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Inserción', 'Agentes',$mensaje, $agente->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('Agentes.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $empresa = Empresas::find( $this->empresa_id );
        $agente = Agentes::where('id',$id)->with('Canales')->with('Grupos')->with('Perfiles')->first();
        $cat_extensiones = Cat_Extensiones::active()->empresa( $this->empresa_id )->get();
        $canales = Canales::active()->where('Empresas_id', $this->empresa_id )->get();
        $grupos = Grupos::active()->where([['Empresas_id', '=', $this->empresa_id],['tipo_grupo','=','Agentes']])->get();
        $perfiles = Perfiles::active()->empresa( $this->empresa_id )->get();

        return view('settings::Agentes.edit',compact('agente', 'canales', 'grupos', 'empresa', 'cat_extensiones', 'perfiles'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(AgentesRequest $request, $id)
    {

        Agentes::where( 'id', $id )
            ->update([
                    'nombre' => $request->input('nombre'),
                    'usuario' => $request->input('usuario'),
                    'email' => $request->input('usuario'),
                    'password' => Hash::make( $request->input('contrasena') ),
                    'contrasena' => $request->input('contrasena'),
                    'extension' => $request->input('extension'),
                    'extension_real' => $request->input('extension'),
                    'nivel' => $request->input('nivel'),
                    'tipo_licencia' => $request->input('tipo_licencia'),
                    'Canales_id' => $request->input('Canales_id'),
                    'mix_monitor' => (int)$request->input('mix_monitor'),
                    'id_perfil_marcacion' => (int)$request->perfil,
                    'calificar_llamada' => (int)$request->input('calificar_llamada'),
                    'envio_sms' => (int)$request->input('envio_sms'),
                    'editar_datos' => (int)$request->input('editar_datos'),
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', información editada: '.var_export($request->all(), true);
            $log = new LogController;
            $log->store('Actualización', 'Agentes',$mensaje, $id);
            return redirect()->route('Agentes.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Agentes::where('id',$id)
        ->update(['activo'=>0]);

        return redirect()->route('Agentes.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'Agentes', $mensaje, $id);

    }
}
