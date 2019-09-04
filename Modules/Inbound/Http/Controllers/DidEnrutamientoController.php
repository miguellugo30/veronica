<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Agentes;
use Nimbus\Did_Enrutamiento;
use Nimbus\Dids;
use Nimbus\Campanas;
//use Nimbus\ivr;
use Nimbus\Audios_Empresa;
use Nimbus\Grupos;
use Nimbus\Cat_Extensiones;

class DidEnrutamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $dids = Dids::active()->where('Empresas_id',$empresa_id)->get();
        //dd($dids);
       $data = array();
        foreach ($dids as $did) {
            $info = [ $did->id, $did->did ];
            if( $did->Did_Enrutamiento == NULL ){
                $desc = '';
                $apli = '';
                $nombre = '';
            }else {
                $desc = $did->Did_Enrutamiento->aplicacion;
                $apli = $did->Did_Enrutamiento->tabla;

                if ( $apli == 'Campanas' ) {
                    $dataApli = Campanas::find( $did->Did_Enrutamiento->tabla_id );
                    $nombre = $dataApli->nombre;
                }else if ( $apli == 'Audios_Empresa' ) {
                    $dataApli = Audios_Empresa::find( $did->Did_Enrutamiento->tabla_id );
                    $nombre = $dataApli->nombre;
                }else if ( $apli == 'Cat_Extensiones' ) {
                    $dataApli = Cat_Extensiones::find( $did->Did_Enrutamiento->tabla_id );
                    $nombre = $dataApli->extension;
                }else if ( $apli == 'hangup' ) {
                    $nombre = 'Colgar';
                }

            }

            array_push($info, $desc, $apli, $nombre);

            array_push($data, $info);
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

        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        if ($data[1] == 'Audios_Empresa') {
            $info = Audios_Empresa::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Campanas') {
            $info = Campanas::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Ivr') {
            $info = [];
        } else if ($data[1] == 'Condiciones_Tiempo') {
            $info = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();
        } else if ($data[1] == 'Cat_Extensiones') {
            $info = Cat_Extensiones::active()->where('Empresas_id', $empresa_id)->get();
        } else if ($data[1] == 'Conferencia') {
            $info = [];
        } else if ($data[1] == 'Aplicacion') {
            $info = [];
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
        $enrutamiento = Did_Enrutamiento::active()->where('Dids_id',$id)->orderBy('prioridad', 'ASC')->get();
        return view('inbound::Did_Enrutamiento.edit',compact('enrutamiento', 'id'));
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
            $data[ $dataForm[$i]['name']] = $dataForm[$i]['value'];
        }

        $idDid = $data['id'];

        array_shift( $data );

        $info = array_chunk( $data, 4 );

        for ($i=0; $i < count($info); $i++) {

            if ($info[$i][0] == NULL) {
                /**
                 * Creamos registro
                 */
                Did_Enrutamiento::create([
                                            'aplicacion' => $info[$i][1],
                                            'tabla' => $info[$i][2],
                                            'tabla_id' => $info[$i][3],
                                            'Dids_id' => $idDid
                                        ]);
            } else {
                /**
                 * Actualizamos registro
                 */
                Did_Enrutamiento::where('id', $info[$i][0])->update([
                                                                    'aplicacion' => $info[$i][1],
                                                                    'tabla' => $info[$i][2],
                                                                    'tabla_id' => $info[$i][3]
                                                                ]);
            }
        }

        return redirect()->route('Did_Enrutamiento.index');

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
}
