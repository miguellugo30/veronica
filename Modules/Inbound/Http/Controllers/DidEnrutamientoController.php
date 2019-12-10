<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Modules\Inbound\Http\Requests\DidEnrutamientoRequest;
use nusoap_client;
use PHPAMI\Ami;

use Nimbus\Empresas;
use Nimbus\Did_Enrutamiento;
use Nimbus\Dids;
use Nimbus\Campanas;
use Nimbus\Ivr;
use Nimbus\Audios_Empresa;
use Nimbus\Grupos;
use Nimbus\Cat_Extensiones;
use Nimbus\Desvios;

class DidEnrutamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $dids = Dids::empresa($empresa_id)->active()->with('Did_Enrutamiento')->get();

        $data = array();
        foreach ($dids as $did) {

            if ( $did->Did_Enrutamiento->activo == 1 ) {
                $info = [ $did->id, $did->did, $did->descripcion ];
                if( $did->Did_Enrutamiento == NULL ){
                    $desc = '';
                    $apli = '';
                    $nombre = '';
                }else {
                    $apli = $did->Did_Enrutamiento->aplicacion;
                    $tabla = $did->Did_Enrutamiento->tabla;

                    if ( $tabla == 'Campanas' ) {
                        $dataApli = Campanas::find( $did->Did_Enrutamiento->tabla_id );
                        $nombre = $dataApli->nombre;
                    }else if ( $tabla == 'Audios_Empresa' ) {
                        $dataApli = Audios_Empresa::find( $did->Did_Enrutamiento->tabla_id );
                        $nombre = $dataApli->nombre;
                    }else if ( $tabla == 'Cat_Extensiones' ) {
                        $dataApli = Cat_Extensiones::find( $did->Did_Enrutamiento->tabla_id );
                        $nombre = $dataApli->extension;
                    }else if ( $tabla == 'Condiciones_Tiempo' ) {
                        $dataApli = Grupos::active()->where([['id', '=', $did->Did_Enrutamiento->tabla_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();
                        $nombre = $dataApli[0]->nombre;
                    }else if ( $tabla == 'Ivr' ) {
                        $dataApli = Ivr::find( $did->Did_Enrutamiento->tabla_id );
                        $nombre = $dataApli->nombre;
                    }else if ( $tabla == 'hangup' ) {
                        $nombre = 'Colgar';
                    } else {
                        $nombre = 'Sin Aplicacion';
                    }

                }
                array_push($info, $apli, $nombre);
                array_push($data, $info);
            }
        }
        return view('inbound::Did_Enrutamiento.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::Did_Enrutamiento.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data = explode( '&', $id );
        $destino = $data[1];
        $num = $data[2];

        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        if ($data[1] == 'Audios_Empresa') {
            $info = Audios_Empresa::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Campanas') {
            $info = Campanas::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Ivr') {
            $info = Ivr::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Condiciones_Tiempo') {
            $info = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();
        } else if ($data[1] == 'Cat_Extensiones') {
            $info = Cat_Extensiones::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Conferencia') {
            $info = [];
        } else if ($data[1] == 'Aplicacion') {
            $info = [];
        } else if ($data[1] == 'Desvios') {
            $info = Desvios::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'hangup') {
            $info = [ ['id' => 0, 'nombre' => 'Colgar'] ];
        }

        return view('inbound::Did_Enrutamiento.show', compact( 'info', 'destino', 'num'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $did = Dids::find( $id );

        $enrutamiento = Did_Enrutamiento::active()->where('Dids_id',$id)->orderBy('prioridad', 'ASC')->get();
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $data = array();
        foreach ($enrutamiento as $v) {
            $datos = [
                        $v->id,
                        $v->aplicacion,
                        $v->tabla,
                        $v->tabla_id
                    ];

            if ($v->tabla == 'Audios_Empresa') {
                $info = Audios_Empresa::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla == 'Campanas') {
                $info = Campanas::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla == 'Ivr') {
                $info = [];
            } else if ($v->tabla == 'Condiciones_Tiempo') {
                $info = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();
            } else if ($v->tabla == 'Cat_Extensiones') {
                $info = Cat_Extensiones::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla == 'Conferencia') {
                $info = [];
            } else if ($v->tabla == 'Aplicacion') {
                $info = [];
            } else if ($v->tabla == 'Desvios') {
                $info = Desvios::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla == 'hangup') {
                $info = [ ['id' => 0, 'nombre' => 'Colgar'] ];
            }

            array_push($datos, $info);
            array_push($data, $datos);

        }

        return view('inbound::Did_Enrutamiento.edit',compact('data', 'id', 'did'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DidEnrutamientoRequest $request, $id)
    {
        /*
        $dataForm = $request->input('dataForm');
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name']] = $dataForm[$i]['value'];
        }

        $idDid = $data['id'];
        $descripcion = $data['descripcion'];

        /*
         * Actualizamos registro
         *
        Dids::where('id', $idDid)->update([ 'descripcion' => $descripcion ]);

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 3 );
        $j = 1;
        for ($i=0; $i < count($info); $i++) {

            if ($info[$i][0] == NULL) {
                /*
                 * Creamos registro
                 *
                Did_Enrutamiento::create([
                                            'aplicacion' => $info[$i][1],
                                            'prioridad' => $j,
                                            'tabla' => $info[$i][1],
                                            'tabla_id' => $info[$i][2],
                                            'Dids_id' => $idDid
                                        ]);
            } else {
                /*
                 * Actualizamos registro
                 *
                Did_Enrutamiento::where('id', $info[$i][0])->update([
                                                                    'aplicacion' => $info[$i][1],
                                                                    'prioridad' => $j,
                                                                    'tabla' => $info[$i][1],
                                                                    'tabla_id' => $info[$i][2]
                                                                ]);
            }
            $j++;
        }
        /*
         * Creamos una petición, para poder escribir
         * los nuevos DID en el archivo EXTENSIONS_DID.CONF
         *
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );
        $result = $client->call('EnrutamientoDid', array(
                                                        'empresas_id' => $empresa_id
                                                    ));
        /*
        * Si la respuesta es 1, se hace el reload del sip
        *
        if ($result['error'] == 1) {
            $ami = new Ami();
            if ($ami->connect($pbx->Config_Empresas->ms->ip_pbx.':5038', $pbx->Config_Empresas->usuario_ami, $pbx->Config_Empresas->clave_ami, 'off') === false)
            {
                throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
            }
            $result  = $ami->command('dialplan Reload');
            $ami->disconnect();
        }
        return redirect()->route('Did_Enrutamiento.index');
        */
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Did_Enrutamiento::where('id',$id)->update(['activo'=>'0']);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Did_Enrutamiento', $mensaje, $id);
    }
}
