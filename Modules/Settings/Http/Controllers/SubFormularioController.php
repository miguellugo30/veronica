<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Nimbus\Formularios;
use Nimbus\Sub_Formularios;
use Nimbus\Campos;

class SubFormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('settings::subFormualrios.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $formularios = Formularios::empresa($empresa_id)->active()->with('Tipo_Marcacion')->get();
        return view('settings::subFormularios.create',compact('formularios'));
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
        return view('settings::subFormualrios.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $campo = Campos::find( $id );
        $tipo_campo = $campo->tipo_campo;

        if( $tipo_campo == 'select' ){

            $opciones = Sub_Formularios::where('Campos_id', $id )->get();
            $formularios = Formularios::active()->get();

            return view('settings::subFormularios.edit', compact('opciones', 'formularios', 'tipo_campo'));

        } else if( $tipo_campo == 'asignador_folios' ){

            return view('settings::subFormularios.edit', compact('campo', 'tipo_campo'));
        }

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $dataForm = json_decode( $request->input('dataOpciones'), true );

        //dd( $dataForm );

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        if ($data['id_tipo'] == 'select') {

            array_shift( $data );
            array_shift( $data );
            $info = array_chunk( $data, 4 );

            for ($i=0; $i < count( $info ); $i++) {
                if ($info[$i][0] != NULL) {
                    Sub_Formularios::where( 'id', $info[$i][0] )->update([
                                                            'opcion' => $info[$i][2],
                                                            'texto' => $info[$i][2],
                                                            'Formularios_id' => $info[$i][3]
                                                        ]);
                } else {
                    Sub_Formularios::create([
                                            'opcion' => $info[$i][2],
                                            'texto' => $info[$i][2],
                                            'Formularios_id' => $info[$i][3],
                                            'Campos_id' => $info[$i][1]
                                        ]);
                }

            }

        } elseif( $data['id_tipo'] == 'asignador_folios' ) {

            array_shift( $data );
            array_shift( $data );

            Campos::where( 'id', $data['id_campo'] )->update([
                                                'prefijo' => $data['prefijo'],
                                                'folio' => $data['folio']
                                            ]);

        }


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Sub_Formularios::destroy($id);
    }
}
