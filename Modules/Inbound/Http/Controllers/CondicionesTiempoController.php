<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\Audios_Empresa;
use Nimbus\Campanas;
use Nimbus\Cat_Extensiones;
use Nimbus\User;
use Nimbus\Condiciones_Tiempo;
use Nimbus\Desvios;
use Nimbus\Grupos;
use Nimbus\Ivr;

class CondicionesTiempoController extends Controller
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

        $condicionestiempo = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();

        return view('inbound::Condiciones_Tiempo.index',compact('condicionestiempo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dias=[
            ['value'=>'mon', 'texto'=>'Lunes'],
            ['value'=>'tue', 'texto'=>'Martes'],
            ['value'=>'wed', 'texto'=>'Miercoles'],
            ['value'=>'thu', 'texto'=>'Jueves'],
            ['value'=>'fri', 'texto'=>'Viernes'],
            ['value'=>'sat', 'texto'=>'Sabado'],
            ['value'=>'sun', 'texto'=>'Domingo'],
        ];

        return view('inbound::Condiciones_Tiempo.create',compact('dias'));
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
            $data[ $dataForm[$i]['name']] = $dataForm[$i]['value'];
        }

        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $grupo = Grupos::create([
                                    'nombre' => $data['nombre'],
                                    'descripcion' => $data['nombre'],
                                    'tipo_grupo' => 'Condiciones de Tiempo',
                                    'Empresas_id' => $empresa_id
                                ]);

        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 13 );

        /**
         * Insertamos la información de los campos
         */
        for ($i=0; $i < count( $info ); $i++) {

            if ( $info[$i][7] == NULL ) {
                $dia_mes_inicio = '*';
                $mes_inicio = '*';
            } else {
                $fecha_inicio = explode('-',  $info[$i][7]);
                $dia_mes_inicio = $fecha_inicio[0];
                $mes_inicio = $fecha_inicio[1];
            }

            if ( $info[$i][8] == NULL ) {
                $dia_mes_fin = '*';
                $mes_fin = '*';
            } else {
                $fecha_fin = explode('-',  $info[$i][8]);
                $dia_mes_fin = $fecha_fin[0];
                $mes_fin = $fecha_fin[1];
            }

            $hora_inicio = $info[$i][1].":".$info[$i][2];
            $hora_fin = $info[$i][3].":".$info[$i][4];

            Condiciones_Tiempo::create([
                                            'nombre' => $info[$i][0],
                                            'hora_inicio' => $hora_inicio,
                                            'hora_fin' => $hora_fin,
                                            'dia_semana_inicio' => $info[$i][5],
                                            'dia_semana_fin' => $info[$i][6],
                                            'dia_mes_inicio' => $dia_mes_inicio,
                                            'dia_mes_fin' => $dia_mes_fin,
                                            'mes_inicio' => $mes_inicio,
                                            'mes_fin' => $mes_fin,
                                            'tabla_verdadero' => $info[$i][9],
                                            'tabla_verdadero_id' => $info[$i][10],
                                            'tabla_falso' => $info[$i][11],
                                            'tabla_falso_id' => $info[$i][12],
                                            'Grupos_id' => $grupo->id
                                        ]);

        }
        return redirect()->route('Condiciones_Tiempo.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        $data = explode( '&', $id );
        $opcion = $data[1];
        $num = $data[2];
        $accion = $data[3];

        $user = User::find( Auth::id() );
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

        return view('inbound::Condiciones_Tiempo.show', compact( 'info', 'opcion', 'num', 'accion' ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $grupo = Grupos::find($id);
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $dias=[
            ['value'=>'mon', 'texto'=>'Lunes'],
            ['value'=>'tue', 'texto'=>'Martes'],
            ['value'=>'wed', 'texto'=>'Miercoles'],
            ['value'=>'thu', 'texto'=>'Jueves'],
            ['value'=>'fri', 'texto'=>'Viernes'],
            ['value'=>'sat', 'texto'=>'Sabado'],
            ['value'=>'sun', 'texto'=>'Domingo'],
        ];

        $condiciones = array();
        foreach ($grupo->Condiciones_Tiempo->where('activo', 1) as $v ) {
            $data = [
                        $v->id,
                        $v->nombre,
                        $v->hora_inicio,
                        $v->hora_fin,
                        $v->dia_semana_inicio,
                        $v->dia_semana_fin,
                        $v->dia_mes_inicio,
                        $v->mes_inicio,
                        $v->dia_mes_fin,
                        $v->mes_fin,
                        $v->tabla_verdadero,
                        $v->tabla_verdadero_id,
                        $v->tabla_falso,
                        $v->tabla_falso_id,
                    ];

            if ($v->tabla_verdadero == 'Audios_Empresa') {
                $info = Audios_Empresa::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_verdadero == 'Campanas') {
                $info = Campanas::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_verdadero == 'Ivr') {
                $info = Ivr::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_verdadero == 'Condiciones_Tiempo') {
                $info = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();
            } else if ($v->tabla_verdadero == 'Cat_Extensiones') {
                $info = Cat_Extensiones::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_verdadero == 'Conferencia') {
                $info = [];
            } else if ($v->tabla_verdadero == 'Aplicacion') {
                $info = [];
            } else if ($v->tabla_verdadero == 'hangup') {
                $info = [ ['id' => 0, 'nombre' => 'Colgar'] ];
            }

            array_push($data, $info);

            if ($v->tabla_falso == 'Audios_Empresa') {
                $info = Audios_Empresa::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_falso == 'Campanas') {
                $info = Campanas::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_falso == 'Ivr') {
                $info = Ivr::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_falso == 'Condiciones_Tiempo') {
                $info = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Condiciones de Tiempo']])->get();
            } else if ($v->tabla_falso == 'Cat_Extensiones') {
                $info = Cat_Extensiones::active()->where('Empresas_id', $empresa_id)->get();
            } else if ($v->tabla_falso == 'Conferencia') {
                $info = [];
            } else if ($v->tabla_falso == 'Aplicacion') {
                $info = [];
            } else if ($v->tabla_falso == 'hangup') {
                $info = [ ['id' => 0, 'nombre' => 'Colgar'] ];
            }

            array_push($data, $info);

            array_push($condiciones, $data);
        }

        //dd( $condiciones );

        return view('inbound::Condiciones_Tiempo.edit', compact('grupo', 'dias', 'condiciones'));
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

        $idGrupo = $data['id_grupo'];

        Grupos::where('id', $idGrupo)->update([
            'nombre' => $data['nombre'],
            'descripcion' => $data['nombre'],
            ]);

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );
        $info = array_chunk( $data, 14 );

        /**
         * Insertamos la información de los campos
         */
        for ($i=0; $i < count( $info ); $i++) {

            if( $info[$i][0] != NULL ) {

                if ( $info[$i][8] == NULL ) {
                    $dia_mes_inicio = '*';
                    $mes_inicio = '*';
                } else {
                    $fecha_inicio = explode('-',  $info[$i][8]);
                    $dia_mes_inicio = $fecha_inicio[0];
                    $mes_inicio = $fecha_inicio[1];
                }

                if ( $info[$i][9] == NULL ) {
                    $dia_mes_fin = '*';
                    $mes_fin = '*';
                } else {
                    $fecha_fin = explode('-',  $info[$i][9]);
                    $dia_mes_fin = $fecha_fin[0];
                    $mes_fin = $fecha_fin[1];
                }

                $hora_inicio = $info[$i][2].":".$info[$i][3];
                $hora_fin = $info[$i][4].":".$info[$i][5];

                Condiciones_Tiempo::where('id', $info[$i][0])->update([
                                                                        'nombre' => $info[$i][1],
                                                                        'hora_inicio' => $hora_inicio,
                                                                        'hora_fin' => $hora_fin,
                                                                        'dia_semana_inicio' => $info[$i][6],
                                                                        'dia_semana_fin' => $info[$i][7],
                                                                        'dia_mes_inicio' => $dia_mes_inicio,
                                                                        'dia_mes_fin' => $dia_mes_fin,
                                                                        'mes_inicio' => $mes_inicio,
                                                                        'mes_fin' => $mes_fin,
                                                                        'tabla_verdadero' => $info[$i][10],
                                                                        'tabla_verdadero_id' => $info[$i][11],
                                                                        'tabla_falso' => $info[$i][12],
                                                                        'tabla_falso_id' => $info[$i][13]
                                                                    ]);

                } else {

                    if ( $info[$i][8] == NULL ) {
                        $dia_mes_inicio = '*';
                        $mes_inicio = '*';
                    } else {
                        $fecha_inicio = explode('-',  $info[$i][8]);
                        $dia_mes_inicio = $fecha_inicio[0];
                        $mes_inicio = $fecha_inicio[1];
                    }

                    if ( $info[$i][9] == NULL ) {
                        $dia_mes_fin = '*';
                        $mes_fin = '*';
                    } else {
                        $fecha_fin = explode('-',  $info[$i][9]);
                        $dia_mes_fin = $fecha_fin[0];
                        $mes_fin = $fecha_fin[1];
                    }

                    $hora_inicio = $info[$i][2].":".$info[$i][3];
                    $hora_fin = $info[$i][4].":".$info[$i][5];

                    Condiciones_Tiempo::create([
                                                    'nombre' => $info[$i][1],
                                                    'hora_inicio' => $hora_inicio,
                                                    'hora_fin' => $hora_fin,
                                                    'dia_semana_inicio' => $info[$i][6],
                                                    'dia_semana_fin' => $info[$i][7],
                                                    'dia_mes_inicio' => $dia_mes_inicio,
                                                    'dia_mes_fin' => $dia_mes_fin,
                                                    'mes_inicio' => $mes_inicio,
                                                    'mes_fin' => $mes_fin,
                                                    'tabla_verdadero' => $info[$i][10],
                                                    'tabla_verdadero_id' => $info[$i][11],
                                                    'tabla_falso' => $info[$i][12],
                                                    'tabla_falso_id' => $info[$i][13],
                                                    'Grupos_id' => $idGrupo
                                                ]);

                }


        }

        return redirect()->route('Condiciones_Tiempo.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

        $data = explode( '&', $id );

        if ($data[1] == 'CDT') {
            Condiciones_Tiempo::where('id',$data[0])->update(['activo'=>'0']);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se Elimino un registro con id: '.$id;
            $log = new LogController;
            $log->store('Eliminacion', 'Condicion_Tiempo', $mensaje, $data[0]);
        } else {

            Grupos::where('id',$data[0])->update(['activo'=>'0']);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se Elimino un registro con id: '.$id;
            $log = new LogController;
            $log->store('Eliminacion', 'Grupos', $mensaje, $data[0]);
        }

        return redirect()->route('Condiciones_Tiempo.index');
    }
}
