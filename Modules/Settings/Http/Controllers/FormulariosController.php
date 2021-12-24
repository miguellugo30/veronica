<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Http\Requests\FormulariosRequest;

use App\User;
use App\Campos;
use App\Formularios;
use App\Sub_Formularios;
use App\Cat_Tipo_Marcacion;
use DB;

class FormulariosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $formularios = Formularios::empresa($empresa_id)->active()->with('Tipo_Marcacion')->get();

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
    public function store(FormulariosRequest $request)
    {
        $data = $request->dataForm;

        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el table de Formularios
         */
        $formulario = Formularios::create([
                                            'nombre'=> $data['nombre'],
                                            'Cat_Tipo_Marcacion_id'=>$data['tipo'],
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
                /**
                 * Obtenemos las opciones que vienen en formato JSON
                 * Y lo convertimos en un array
                 */
                $opciones = json_decode($info[$i][5], true);
                /**
                 * Insertamos el campo de tipo select
                 */
                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4],
                                            'prefijo' => $opciones[0]['value'],
                                            'folio' => $opciones[1]['value']
                                        ]);

            } else if ( $info[$i][1] == 'select' ) {
                /**
                 * Obtenemos las opciones que vienen en formato JSON
                 * Y lo convertimos en un array
                 */
                $opciones = json_decode($info[$i][5], true);
                /**
                 * Insertamos el campo de tipo select
                 */
                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4]
                                        ]);
                /**
                 * Insertamos las opciones y las relacionamos al campo
                 * y al formulario que llamara si eligen uno
                 */
                $k = 0;
                for ($j=0; $j < ( count($opciones) / 2 ); $j++) {
                    Sub_Formularios::create([
                                                'opcion' => $opciones[$k]['value'],
                                                'texto' => $opciones[$k]['value'],
                                                'Formularios_id' => $opciones[$k+1]['value'],
                                                'Campos_id' =>$campo->id
                                            ]);
                    $k = $k + 2;
                }

            } else {
                /**
                 * Insertamos un campo
                 */
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
    public function update(FormulariosRequest $request, $id)
    {

        $data = $request->dataForm;


        $idFormulario = $data['id_formulario'];

        array_shift( $data );
        $info = array_chunk( $data, 6 );

        for ($i=0; $i < count( $info ); $i++) {
            if ($info[$i][0] != 0) {
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
        ->update(['activo'=>0]);

        return redirect()->route('formularios.index');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function duplicate(Request $request, $id)
    {
        /**
         * Buscamos el formulario a duplicar
         */
        $form = Formularios::find( $id );
        /**
         * Insertar información el table de Formularios
         */
        $formulario = Formularios::create([
                                            'nombre' => $request->input('nombreForm'),
                                            'Cat_Tipo_Marcacion_id' => $form->Cat_Tipo_Marcacion_id,
                                            'Empresas_id' => $form->Empresas_id
                                        ]);

        foreach ( $form->Formularios_Campos as $v) {
            DB::table('Formularios_Campos')->insert(
                ['Formularios_id' => $formulario->id, 'Campos_id' => $v->id]
            );
        }

        return redirect()->route('formularios.index');
    }
}
