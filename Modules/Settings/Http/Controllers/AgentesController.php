<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Nimbus\User;
use Nimbus\Agentes;
use Nimbus\Canales;
use Nimbus\Grupos;
use Nimbus\Empresas;


class AgentesController extends Controller
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
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $agentes = Agentes::active()->where('Empresas_id',$empresa_id)->get();
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
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $empresa = Empresas::find( $empresa_id );
        $canales = Canales::active()->where('Empresas_id', $empresa_id)->get();
        $grupos = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Agentes']])->get();

        return view('settings::Agentes.create', compact('canales', 'grupos', 'empresa'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Insertamos la información del Agente
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertamos el nuevo agentes
         */
        $datos = $request->all();
        $datos['Empresas_id'] = $empresa_id;
        $datos['password'] = Hash::make( $datos['contrasena'] );
        $datos['email'] = $datos['usuario'];
        $agente = Agentes::create($datos);
        /**
         * Buscamos el grupo para poderlo vincular al agente
         */
        if( $datos['grupo'] != '' ){

            $grupo = Grupos::find(  $datos['grupo'] );
            $grupo->Agentes()->attach($agente->id);

        }
        /**
         * Creamos una petición, para poder escribir
         * los agentes en el archivo AGENTS.CONF
         */
        $ch = curl_init();
        // definimos la URL a la que hacemos la petición
        curl_setopt($ch, CURLOPT_URL,"10.255.242.136/api-contextos/agentes.php");
        // indicamos el tipo de petición: POST
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // definimos cada uno de los parámetros
        curl_setopt($ch, CURLOPT_POSTFIELDS, "empresa_id=".$empresa_id);
        // recibimos la respuesta y la guardamos en una variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $remote_server_output = curl_exec ($ch);
        print_r( $remote_server_output );
        // cerramos la sesión cURL
        curl_close ($ch);
        /**
         * Si la respuesta es 1, se hace el reload del sip
         */
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Agentes',$mensaje, $agente->id);
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
        /**
         * Obtenemos el id empresa del usuario para obtener los canales
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $empresa = Empresas::find( $empresa_id );
        $agente = Agentes::where('id',$id)->first();
        $canales = Canales::active()->where('Empresas_id', $empresa_id)->get();
        $grupos = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Agentes']])->get();

        return view('settings::Agentes.edit',compact('agente', 'canales', 'grupos', 'empresa'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        Agentes::where( 'id', $id )
            ->update([
                    'nombre' => $request->input('nombre'),
                    'usuario' => $request->input('usuario'),
                    'contrasena' => $request->input('contrasena'),
                    'extension' => $request->input('extension'),
                    'nivel' => $request->input('nivel'),
                    'Canales_id' => $request->input('Canales_id'),
                    'mix_monitor' => $request->input('mix_monitor'),
                    'calificar_llamada' => $request->input('calificar_llamada'),
                    'envio_sms' => $request->input('envio_sms'),
                    'editar_datos' => $request->input('editar_datos'),
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request, true);
            $log = new LogController;
            $log->store('Actualizacion', 'Agentes',$mensaje, $id);
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
        ->update(['activo'=>'0']);

        return redirect()->route('Agentes.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Agentes', $mensaje, $id);

    }
}
