<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Ivr;
use Nimbus\Audios_Empresa;
use Nimbus\Ivr_Opciones;
use Nimbus\Campanas;
use Nimbus\Grupos;
use Nimbus\Cat_Extensiones;
use Nimbus\Desvios;

class IvrController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $ivrs = Ivr::active()->where('Empresas_id',$empresa_id)->get();
        $data = array();
        foreach ($ivrs as $ivr) {

            $datos = [ $ivr->id, $ivr->nombre, $ivr->tiempo_espera, $ivr->repeticiones ];

            $audios = Audios_Empresa::find( [ $ivr->mensaje_bienvenida_id, $ivr->mensaje_tiempo_espera_id, $ivr->mensaje_opcion_invalida_id ] );

            foreach ($audios as $audio) {

                array_push($datos, $audio->nombre);
            }

            array_push($data, $datos);
        }

        return view('inbound::Ivr.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $audios = Audios_Empresa::active()->where('Empresas_id',$empresa_id)->get();

        return view('inbound::Ivr.create',compact('empresa_id','audios'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        for ($i=0; $i < count( $request->input('dataForm') ); $i++) {
            $data[ $request->input('dataForm')[$i]['name']] = $request->input('dataForm')[$i]['value'];
        }
        /**
        * Insertar información del Ivr
        */
        $ivr = Ivr::create([
                                'nombre' => $data['nombre'],
                                'mensaje_bienvenida_id'   => $data['mensaje_bienvenida_id'],
                                'tiempo_espera' => $data['tiempo_espera'],
                                'mensaje_tiempo_espera_id' => $data['mensaje_tiempo_espera_id'],
                                'mensaje_opcion_invalida_id' => $data['mensaje_opcion_invalida_id'],
                                'repeticiones' => $data['repeticiones'],
                                'Empresas_id' => $data['Empresas_id']
                            ]);

        unset(
                $data['Empresas_id'],
                $data['nombre'],
                $data['_token'],
                $data['mensaje_bienvenida_id'],
                $data['tiempo_espera'],
                $data['mensaje_tiempo_espera_id'],
                $data['mensaje_opcion_invalida_id'],
                $data['repeticiones'],
                $data['Empresas_id']
            );

        $info = array_chunk( $data, 4 );

        for ($i=0; $i < count($info); $i++) {
            Ivr_Opciones::create([
                                    'tipo' => $info[$i][0],
                                    'digito' => $info[$i][1],
                                    'tabla' => $info[$i][2],
                                    'tabla_id' => $info[$i][3],
                                    'Ivr_id' => $ivr->id
                                ]);
        }
        /**
         * Creamos el logs
         */
        $user = User::find( Auth::id() );
        $mensaje = 'Se creo un nuevo registro, información capturada:'.var_export($request->input('dataForm'), true);
        $log = new LogController;
        $log->store('Creacion', 'Ivr',$mensaje, $user->id);

        return redirect()->route('Ivr.index');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $audios = Audios_Empresa::active()->where('Empresas_id',$empresa_id)->get();
        $ivr = Ivr::find( $id );

        $data = array();
        foreach ($ivr->Ivr_Opciones as $v) {
            $datos = [
                        $v->id,
                        $v->tipo,
                        $v->digito,
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

        return view('inbound::Ivr.edit',compact('ivr', 'empresa_id','audios', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        for ($i=0; $i < count( $request->input('dataForm') ); $i++) {
            $data[ $request->input('dataForm')[$i]['name']] = $request->input('dataForm')[$i]['value'];
        }
        /**
        * Actualizamos información del Ivr
        */
        $ivr = Ivr::where('id', $data['ivr_id'])->update([
                                                        'nombre' => $data['nombre'],
                                                        'mensaje_bienvenida_id'   => $data['mensaje_bienvenida_id'],
                                                        'tiempo_espera' => $data['tiempo_espera'],
                                                        'mensaje_tiempo_espera_id' => $data['mensaje_tiempo_espera_id'],
                                                        'mensaje_opcion_invalida_id' => $data['mensaje_opcion_invalida_id'],
                                                        'repeticiones' => $data['repeticiones']
                                                    ]);

        $idIvr = $data['ivr_id'];
        unset(
                $data['Empresas_id'],
                $data['ivr_id'],
                $data['_token'],
                $data['nombre'],
                $data['mensaje_bienvenida_id'],
                $data['tiempo_espera'],
                $data['mensaje_tiempo_espera_id'],
                $data['mensaje_opcion_invalida_id'],
                $data['repeticiones']
            );

        $info = array_chunk( $data, 5 );

        for ($i=0; $i < count($info); $i++) {

            if ($info[$i][0] == NULL) {
                /**
                 * Creamos registro
                 */
                Ivr_Opciones::create([
                                        'tipo' => $info[$i][1],
                                        'digito' => $info[$i][2],
                                        'tabla' => $info[$i][3],
                                        'tabla_id' => $info[$i][4],
                                        'Ivr_id' => $idIvr
                                    ]);
            } else {
                /**
                 * Actualizamos registro
                 */
                Ivr_Opciones::where('id', $info[$i][0])->update([
                                                                    'tipo' => $info[$i][1],
                                                                    'digito' => $info[$i][2],
                                                                    'tabla' => $info[$i][3],
                                                                    'tabla_id' => $info[$i][4]
                                                                ]);
            }
        }
        return redirect()->route('Ivr.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Ivr::where('id',$id)->update(['activo'=>'0']);
        /**
         * Creamos el logs
         */
        $user = User::find( Auth::id() );
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'Ivr',$mensaje, $user->id);

        return redirect()->route('Ivr.index');
    }
}
