<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PHPAMI\Ami;
use nusoap_client;

use Nimbus\Empresas;
use Nimbus\Troncales;
use Nimbus\Troncales_Sansay;
use Nimbus\Cat_Distribuidor;
use Nimbus\Cat_IP_PBX;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;

class TroncalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos las troncales que esten activos
         */
        $troncales = Troncales::active()->with('Cat_Distribuidor')->with('Troncales_Sansay')->get();
        return view('administrador::troncales.index', compact('troncales'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Recuperamos todos las troncales que esten activos
         */
        $distribuidores = Cat_Distribuidor::active()->get();

        /**
         * Recuperamos todos los Media Server que esten activos
         */
        $mediaserver = Cat_IP_PBX::active()->get();

        return view('administrador::troncales.create', compact('distribuidores','mediaserver'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la información del formulario
         */
        $cat = Troncales::create( $request->all() );

        Troncales_Sansay::create([
                                    'name' => $request->input('nombre'),
                                    'host' => $request->input('ip_host'),
                                    'Troncales_id' => $cat->id
                                ]);
        /**
         * Creamos una petición, para poder escribir
         * los nuevos DID en el archivo EXTENSIONS_DID.CONF
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $pbx = Empresas::where('id',$empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$request->input('Cat_IP_PBX_id').'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );
        $result = $client->call('Troncales', array(
                                                        'empresas_id' => $empresa_id
                                                    ));
        /**
         * Si la respuesta es 1, se hace el reload del sip
         */
        if ($result['error'] == 1) {
            $ami = new Ami();
            if ($ami->connect($request->input('Cat_IP_PBX_id').':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
            {
                throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
            }
            $result  = $ami->command('dialplan Reload');
            $ami->disconnect();
        }

        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Troncales',$mensaje, $cat->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $configuracion = Troncales_Sansay::where( 'Troncales_id', $id )->get();
        return view('administrador::troncales.show', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Recuperamos todos las troncales que esten activos
         */
        $distribuidores = Cat_Distribuidor::active()->get();
        /**
         * Obtenemos la informacion de la troncal a editar
         */
        $troncal = Troncales::findOrFail( $id );

        $medias = Cat_IP_PBX::active()->get();

        return view('administrador::troncales.edit', compact('troncal', 'id', 'distribuidores','medias') );
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
         * Actualizamos la troncal
         */
        Troncales::where( 'id', $id )
                                ->update([
                                    'nombre' => $request->input('nombre'),
                                    'descripcion' => $request->input('descripcion'),
                                    //'ip_host' => $request->input('ip_host'),
                                    'Cat_Distribuidor_id' => $request->input('Cat_Distribuidor_id'),
                                    //'Cat_IP_PBX_id' => $request->input('Cat_IP_PBX_id'),
                                ]);

        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Troncales',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos la trocal ha activo 0
         */
        Troncales::where( 'id', $id )
                   ->update([
                       'activo' => '0',
                   ]);
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Troncales',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateSansay(Request $request, $id)
    {
        /**
         * Actualizamos la troncal
         */
        Troncales_Sansay::where( 'id', $id )
                                ->update([
                                    'host' => $request->input('host'),
                                    'dtmfmode' => $request->input('dtmfmode'),
                                    'allow' => $request->input('allow'),
                                ]);

        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Troncales',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('troncales.index');
    }



}
