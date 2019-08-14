<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Formularios;
use Nimbus\Cat_Tipo_Marcacion;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Campos;
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
         * Obtener los tipos de marcacion
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
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }
         /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar informacion el table de Formularios
         */
        $formulario = Formularios::create([
                                            'nombre'=> $data['nombre'],
                                            'Cat_Tipo_Marcacion_id'=>$data['tipo'],
                                            'Empresas_id'=>$empresa_id
                                        ]);
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 5 );

        /**
         * Insertamos la informacion de los campos
         */
        for ($i=0; $i < count( $info ); $i++) {

            $campo = Campos::create([
                                        'nombre_campo' => $info[$i][0],
                                        'tipo_campo' => $info[$i][1],
                                        'tamano' => $info[$i][2],
                                        'obligatorio' => $info[$i][3],
                                        'editable' => $info[$i][4]
                                    ]);

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
        //dd($formulario->Formularios_Campos);
        return view('settings::Formularios.show', compact('campos'));

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
        //
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
