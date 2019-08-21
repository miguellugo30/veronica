<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Campos;
use Nimbus\Formularios;
use Nimbus\Sub_Formularios;
use Nimbus\Cat_Tipo_Marcacion;
use DB;

class FormulariosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $formularios = Formularios::active()->get();
        return view('settings::Formularios.index',compact('formularios'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtener los tipos de marcacion para el tipo de formulario
         */
        $TipoMarcacion = Cat_Tipo_Marcacion::all();

        return view('settings::Formularios.create', compact('TipoMarcacion'));
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
            $data[ $dataForm[$i]['name']."_".$i ] = $dataForm[$i]['value'];
        }

         /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el table de Formularios
         */
         $formulario = Formularios::create([
             'nombre'=> $data['nombre_1'],
             'Cat_Tipo_Marcacion_id'=>$data['tipo_0'],
             'Empresas_id'=>$empresa_id
             ]);

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 6 );

        /**
         * Insertamos la información de los campos
         */

        for ($i=0; $i < count( $info ); $i++) {

            if ( $info[$i][1] == 'asignador_folios' ) {

                $folio = array();
                $b =  explode( '&', $info[$i][5]);
                for ($j=0; $j < count($b); $j++) {
                    $c = explode('=',$b[$j]);
                    array_push( $folio, $c[1] );
                }

                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4],
                                            'prefijo' => $folio[0],
                                            'folio' => $folio[1]
                                        ]);
            } else if ( $info[$i][1] == 'select' ) {

                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4]
                                        ]);

                $b =  explode( '&', $info[$i][5]);
                $k = 0;
                for ($j=0; $j < ( count($b) / 2 ); $j++) {
                    $c = explode('=',$b[$k]);
                    $d = explode('=',$b[$k + 1]);

                    Sub_Formularios::create([
                        'opcion' => urldecode( $c[1] ),
                        'texto' => urldecode( $c[1] ),
                        'Formularios_id' => $d[1],
                        'Campos_id' =>$campo->id
                    ]);

                    $k = $k + 2;
                }

            } else {
                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4]
                                        ]);
            }

            DB::table('Formularios_Campos')->insert(
                ['Formularios_id' => $formulario->id, 'Campos_id' => $campo->id]
            );

        }

        return redirect()->route('formularios.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $formulario = Formularios::find( $id );
        $campos = $formulario->Formularios_Campos;

        return view('settings::Formularios.show', compact('formulario', 'campos'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $formulario = Formularios::find( $id );
        $campos = $formulario->Formularios_Campos;
        $TipoMarcacion = Cat_Tipo_Marcacion::all();

        //dd($campos);
        return view('settings::Formularios.edit', compact('campos','formulario','TipoMarcacion'));
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

        $idFormulario = $data['id_formulario'];
        $registrosEliminados = $data['registro_borrados'];

        if( $registrosEliminados != '' ){
            $registros = explode(',', $registrosEliminados);

            $form = Formularios::find( $idFormulario );
            $form->Formularios_Campos()->detach($registros);

        }

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 6 );

        for ($i=0; $i < count( $info ); $i++) {
            if ($info[$i][0] != NULL) {
                Campos::where( 'id', $info[$i][0] )->update([
                                                        'nombre_campo' => $info[$i][1],
                                                        'tipo_campo' => $info[$i][2],
                                                        'tamano' => $info[$i][3],
                                                        'obligatorio' => $info[$i][4],
                                                        'editable' => $info[$i][5]
                                                    ]);
            } else {
                $campo = Campos::create([
                                        'nombre_campo' => $info[$i][1],
                                        'tipo_campo' => $info[$i][2],
                                        'tamano' => $info[$i][3],
                                        'obligatorio' => $info[$i][4],
                                        'editable' => $info[$i][5]
                                    ]);

                DB::table('Formularios_Campos')->insert(
                    ['Formularios_id' => $idFormulario, 'Campos_id' => $campo->id]
                );
            }

        }

        return redirect()->route('formularios.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Formularios::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('formularios.index');
    }
}
