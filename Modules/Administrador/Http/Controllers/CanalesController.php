<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Canales;
use Nimbus\Cat_Distribuidor;
use Nimbus\Cat_Tipo_Canales;
use Nimbus\Empresas;
use Nimbus\Troncales;

class CanalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos los canales que esten activos
         */
        $canales = Canales::where('activo',1)->get();
        return view('administrador::canales.index', compact('canales'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        /**
         * Recuperamos todos los distribuidores que esten activos
         */
        $empresas = Empresas::findOrFail($id);
        $distribuidor = Cat_Distribuidor::findOrFail( $empresas->Config_Empresas->Cat_Distribuidor_id );
        $troncales = $distribuidor->Troncales;
        $canales = Cat_Tipo_Canales::where('Cat_Distribuidor_id', $empresas->Config_Empresas->Cat_Distribuidor_id)->get();

        return view('administrador::canales.create', compact( 'troncales', 'empresas','distribuidor','canales') );
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
        $id_Distribuidor = $data['Cat_Distribuidor_id'];
        $id_Empresa = $data['Empresa_id'];
        $prefijo = $data['preDist'].$data['preEmp'];

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 4 );

        for($i=0;$i<count($info);$i++){

            if ( $info[$i][1] == 'LOCAL/' ) {
                $Troncales_id = 1;
            } else {
                $Troncales_id = $info[$i][2];
            }


           Canales::create([
                'protocolo'=>$info[$i][1],
                'prefijo'=>$prefijo.$info[$i][3],
                'Troncales_id'=>$Troncales_id,
                'Cat_Distribuidor_id'=>$id_Distribuidor,
                'Cat_Canales_Tipo_id'=>$info[$i][0],
                'Empresas_id'=>$id_Empresa
           ]);
       }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($idEmpresa)
    {
        /**
         * Buscamos la informacion de la empresa
         */
        $empresas = Empresas::findOrFail($idEmpresa);
        /**
         * Devolvemos la informacion de los canales de la empresa
         */
        $canales = Canales::active()->where('Empresas_id', $idEmpresa )->get();
        /**
         * Recuperamos los tipo de canales en base al distribuidor que esta dado de alta la empresa
         */
        $TipoCanales = Cat_Tipo_Canales::active()->where('Cat_Distribuidor_id', $empresas->Config_Empresas->Cat_Distribuidor_id)->get();
        /**
         * Recuperamos las troncales asociadas a la empresa
         */
        $troncales = Troncales::where([
                                        ['activo', '=', '1'],
                                        ['Cat_Distribuidor_id', '=',  $empresas->Config_Empresas->Cat_Distribuidor_id]
                                    ])->get();


        return view('administrador::canales.show', compact('canales', 'idEmpresa', 'TipoCanales', 'troncales') );
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Recuperamos el canal ha editar
         */
        $canal = Canales::findOrFail($id);

        /**
         * Recuperamos todos los distribuidores que esten activos
         */
        $distribuidores = Cat_Distribuidor::where('activo',1)->get();

        $distribuidor = Cat_Distribuidor::findOrFail( $canal->Cat_Distribuidor_id );

        $troncales = $distribuidor->Troncales;
        $empresas = $distribuidor->Config_Empresas->all();

        $tipo_canales = Cat_Tipo_Canales::where('Cat_Distribuidor_id',$distribuidor->id)->get();
        return view('administrador::canales.edit', compact( 'canal', 'distribuidores', 'troncales', 'empresas','tipo_canales'));
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

        $info = array_chunk( $data, 6 );

        for($i=0;$i<count($info);$i++){
            /**
             * Actualizamos el canal
             */
            if ( $info[$i][2] == 'LOCAL/' ) {
                $Troncales_id = 1;
            } else {
                $Troncales_id = $info[$i][3];
            }
            Canales::where([
                                ['Empresas_id', '=', $id],
                                ['id', '=', $info[$i][0]],
                            ])
                                    ->update([
                                        'protocolo' => $info[$i][2],
                                        'prefijo' => $info[$i][5].$info[$i][4],
                                        'Troncales_id' => $Troncales_id,
                                        'Cat_Canales_Tipo_id' => $info[$i][1],
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
         /**
         * Actualizamos la trocal ha activo 0
         */
        Canales::where( 'id', $id )
                   ->update([
                       'activo' => '0',
                   ]);
        /**
         * Redirigimos a la ruta index
         */
        //return redirect()->route('canales.index');
    }

}
