<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Canales;
use Nimbus\Cat_Extensiones;
use Nimbus\Config_Empresas;

class CatExtensionesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('administrador::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        /**
         * Recuperamos los canales que estan asocioados a la empresa
         */
        $canales = Canales::active()->where('Empresas_id', $id )->get();

        /**
         * Obtenemos las extensiones que ya tiene la empresa
         */
        $extensiones = Cat_Extensiones::active()->where('Empresas_id', $id)->get();
        $extCreadas = $extensiones->count();
        /**
         * Obtenemos las posiciones asignadas para la empresa
         */
        $configEmpresa = Config_Empresas::where('Empresas_id', $id )->get();
        $numExtensiones = $configEmpresa[0]->agentes_entrada + $configEmpresa[0]->agentes_salida + $configEmpresa[0]->agentes_dual;


        return view('administrador::cat_extensiones.create', compact('id', 'canales', 'numExtensiones', 'extCreadas', 'extensiones') );
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
         * Guardamos la informacion del nuevo dominio
         */
        for ($i=0; $i < (int)$data['posiciones']; $i++) {
            $catExtension = new Cat_Extensiones;
            $catExtension->extension = (int)$data['extension'] + $i;
            $catExtension->Empresas_id = $data['id_empresa'];
            $catExtension->Canales_id = $data['canal_id'];
            $catExtension->save();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Obtenemos las extensiones que ya tiene la empresa
         */
        $extensiones = Cat_Extensiones::active()->where('Empresas_id', $id)->get();
        $extCreadas = $extensiones->count();
        /**
         * Obtenemos las posiciones asignadas para la empresa
         */
        $configEmpresa = Config_Empresas::where('Empresas_id', $id )->get();
        $numExtensiones = $configEmpresa[0]->agentes_entrada + $configEmpresa[0]->agentes_salida + $configEmpresa[0]->agentes_dual;
        /**
         * Devolvemos la informacion de los tipos de canales de la empresa
         */
        $canales = Canales::active()->where('Empresas_id', $id )->get();
        $idEmpresa = $id;
        //return view('administrador::empresas.extensiones',compact( 'id', 'canales', 'numExtensiones', 'extCreadas', 'extensiones') );
        return view('administrador::cat_extensiones.show', compact( 'idEmpresa', 'canales', 'numExtensiones', 'extCreadas', 'extensiones'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('administrador::edit');
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
        array_shift( $data );

        $info = array_chunk( $data, 3 );

        for($i=0;$i<count($info);$i++){
            /**
             * Actualizamos la extension
             */
            Cat_Extensiones::where( [
                                        ['id', '=',  $info[$i][0] ],
                                        ['Empresas_id', '=', $id]
                                    ])->update([
                                        'extension' => $info[$i][2],
                                        'Canales_id' =>  $info[$i][1]
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
         * Actualizamos a 0 la extension
         */
        Cat_Extensiones::where( 'id', $id )
                                ->update([
                                    'activo' => 0
                                ]);
    }
}
