<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
/*
* Agregar el modelo de la tabla que debe usar nuestro modulo
*/
use Nimbus\Dids;
// Agregar modelo Clientes para acceder a los datos
use Nimbus\Empresas;
use Nimbus\Canales;
use PHPAMI\Ami;

class DidController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */


    public function index()
    {
        /**
         * Recuperamos todos los did que esten activos
         */
        $Dids = Dids::active()->with('Empresas')->with('Canales.Troncales')->get();
        return view('administrador::dids.index', compact('Dids'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        /**
         * Obtenemos los canales de la empresa
         */
        $canales = Canales::active()->where('Empresas_id', $id)->get();

        return view('administrador::dids.create', compact( 'canales', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }
        //dd($data);
        /**
         * Obtener los dids que se van a insertar separados por ;
         */
        $dids_store = explode(";", str_replace("\n",";",$data['did'] ));
        /**
         * Se recorre arreglo de dids
         */
        for ($i=0; $i < count($dids_store); $i++) {
            $empresa_id = $data['id_empresa'];
            $cat = Dids::create([
                                    'did'=>trim($dids_store[$i]),
                                    'numero_real'=>$data['numero_real'],
                                    'referencia'=>$data['referencia'],
                                    'gateway'=>$data['gateway'],
                                    'fakedid'=>$data['fakedid'],
                                    'Canales_id'=> $data['Canal_id'],
                                    'Empresas_id'=>$data['id_empresa']
                                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se creo un nuevo registro, información capturada:'.var_export($data, true);
            $log = new LogController;
            $log->store('Inserción', 'Dids',$mensaje, $cat->id);
        }
        /**
         * Creamos una petición, para poder escribir
         * los nuevos DID en el archivo EXTENSIONS_DID.CONF
         */
        $ch = curl_init();
        // definimos la URL a la que hacemos la petición
        curl_setopt($ch, CURLOPT_URL,"10.255.242.136/api-contextos/contexto_did.php");
        // indicamos el tipo de petición: POST
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // definimos cada uno de los parámetros
        curl_setopt($ch, CURLOPT_POSTFIELDS, "empresa_id=".$empresa_id);
        // recibimos la respuesta y la guardamos en una variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $remote_server_output = curl_exec ($ch);
        // cerramos la sesión cURL
        curl_close ($ch);
        /**
         * Si la respuesta es 1, se hace el reload del dialplan
         */
        if ($remote_server_output == 1) {
            $ami = new Ami();
            if ($ami->connect('10.255.242.136:5038', 'Call_Center', 'Call_C3nt3r_1nf1n1t', 'off') === false) {
               throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
            }
            $result  = $ami->command('dialplan Reload');

            $ami->disconnect();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Obtenemos los Dids de la empresa
         */
        $dids = Dids::active()->where('Empresas_id', $id)->get();
        /**
         * Obtenemos los canales de la empresa
         */
        $canales = Canales::active()->where('Empresas_id', $id)->get();

        return view('administrador::dids.show',compact('dids', 'canales', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la información del DID ha editar
         */
        $Dids = Dids::find($id);
        /**
         * Obtenemos las empresas activas
         */
        $empresas = Empresas::where('activo',1)->get();
        /**
         * Obtenemos los canales que están vinculadas a la empresa vinculada al DID
         */
        $empresa = Empresas::findOrFail(  $Dids->Empresas->id );
        $canales = $empresa->canales;
        return view('administrador::dids.edit',compact('Dids', 'empresas', 'canales'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 7 );

        for($i=0;$i<count($info);$i++){

            Dids::where([
                            ['Empresas_id', '=', $id],
                            ['id', '=', $info[$i][0]],
                        ])->update([
                            'did' => $info[$i][2],
                            'numero_real' => $info[$i][4],
                            'referencia' => $info[$i][3],
                            'gateway' => $info[$i][5],
                            'fakedid' => $info[$i][6],
                            'Canales_id' => $info[$i][1],
                        ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$info[$i][0].', informacion editada: '.var_export($info[$i], true);
            $log = new LogController;
            $log->store('Actualización', 'Categorías',$mensaje, $info[$i][0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Dids::where( 'id', $id )->update(['activo' => 0]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'Dids',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('did.index');
    }
}
