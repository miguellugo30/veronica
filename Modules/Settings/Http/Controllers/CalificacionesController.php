<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
/**
 * Modelos
 */
use Nimbus\Calificaciones;
use Nimbus\Grupos;
use Nimbus\User;
use Nimbus\Formularios;

class CalificacionesController extends Controller
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
        /**
         * Obtener los valores activos de nuestra tabala calificaciones
         */
        $calificaciones = Grupos::active()->where([['Empresas_id', '=', $empresa_id],['tipo_grupo','=','Calificaciones']])->get();
        return view('settings::Calificaciones.index', compact('calificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $formularios = Formularios::active()->where('Empresas_id', $empresa_id)->get();
        return view('settings::Calificaciones.create', compact('formularios'));
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
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el table de Grupos
         */
        $grupo = Grupos::create([
                        'nombre'=>  $data['nombre'],
                        'descripcion'=> $data['descripcion'],
                        'tipo_grupo'=> 'Calificaciones',
                        'Empresas_id'=>$empresa_id
                    ]);

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 2 );
        /**
         * Insertamos la información de las calificaciones
         */
        for ($i=0; $i < count( $info ); $i++) {

            $calificacion = Calificaciones::create([
                            'nombre' => $info[$i][0],
                            'tipo' => 'Inbound',
                            'Formularios_id' => $info[$i][1]
                        ]);

            $grupo->Calificaciones()->attach($calificacion);

        }

        return redirect()->route('calificaciones.index');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $grupo =  Grupos::find( $id );

        return view('settings::Calificaciones.show',compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
         /**
         * Sacamos los datos del agente y su empresa para obtener los agentes
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $grupo = Grupos::find( $id );

        $formularios = Formularios::active()->where('Empresas_id', $empresa_id)->get();

        return view('settings::Calificaciones.edit', compact('grupo','formularios'));
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

        $grupo =  Grupos::find( $id );
        /**
         * Actualizar información el table de Grupos
         */
        Grupos::where( 'id', $id )->update([
                                        'nombre' => $data['nombre'],
                                        'descripcion' => $data['descripcion']
                                    ]);

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 3 );
        /**
         * Actualizamos la información de las calificaciones
         */
        for ($i=0; $i < count( $info ); $i++) {

            if ( $info[$i][0] == '' ) {

                $calificacion = Calificaciones::create([
                                    'nombre' => $info[$i][1],
                                    'tipo' => 'Inbound',
                                    'Formularios_id' => $info[$i][2]
                                ]);

                $grupo->Calificaciones()->attach($calificacion);

            } else {

                Calificaciones::where( 'id', $info[$i][0] )->update([
                                                        'nombre' => $info[$i][1],
                                                        'Formularios_id' => $info[$i][2]
                                                    ]);
            }

        }

        return redirect()->route('calificaciones.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
         /**
         * Actualizar información el table de Grupos
         */
        Grupos::where( 'id', $id )->update(['activo' => 0]);

        return redirect()->route('calificaciones.index');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroyCalificacion($id)
    {
        /**
         * Actualizar información el table de Grupos
         */
        $calificacion = Calificaciones::find( $id );

        $calificacion->Grupos()->detach();
    }
     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function duplicate(Request $request, $id)
    {
        /**
         * Buscamos el grupo ha duplicar
         */
        $grupo = Grupos::find( $id );
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el table de Grupos
         */
        $grupoNew = Grupos::create([
                        'nombre'=>  $request->input('nombreForm'),
                        'descripcion'=>  $request->input('nombreForm'),
                        'tipo_grupo'=> 'Calificaciones',
                        'Empresas_id'=>$empresa_id
                    ]);

        foreach ( $grupo->Calificaciones as $v) {

            $calificacion = Calificaciones::create([
                                                'nombre' => $v->nombre,
                                                'tipo' => 'Inbound',
                                                'Formularios_id' => $v->Formularios_id
                                            ]);

            $grupoNew->Calificaciones()->attach($calificacion);

        }

        return redirect()->route('calificaciones.index');
    }
}
