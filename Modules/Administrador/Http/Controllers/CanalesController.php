<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Canales;
use Nimbus\Cat_Distribuidor;
use Nimbus\Troncales;
use Nimbus\Config_Empresas;
use Nimbus\Cat_Tipo_Canales;

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
    public function create()
    {
        /**
         * Recuperamos todos los distribuidores que esten activos
         */
        $distribuidores = Cat_Distribuidor::where('activo',1)->get();
        return view('administrador::canales.create', compact('distribuidores') );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
       /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la informacion del formulario
         */
        $canales_recibidos = $request->canales;

        $canales = explode(";",$canales_recibidos);

        /*foreach($canales as $canal=> $value){
            Canales::create(['canal'
            ,'Empresas_id'=>$request->Empresas_id
            ,'Troncales_id' = $request->Troncales_id;
            ,'Cat_Distribuidor_id' = $request->Cat_Distribuidor_id;
        }*/

        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('canales.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $distribuidor = Cat_Distribuidor::findOrFail($id);

        $troncales = $distribuidor->Troncales;
        $empresas = $distribuidor->Config_Empresas->all();
            
        $canales = Cat_Tipo_Canales::where('Cat_Distribuidor_id',$id)->get();
        
        return view('administrador::canales.show', compact( 'troncales', 'empresas','distribuidor','canales'));
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

        /**
         * Arreglos que almacenan el tipo de canal el primer arreglo almacena los de telmex y el segundo almacena los de c3ntro.
         */
        $tipo_canal_telmex = array(['id' => '1','tipo' => 'Offnet(Salida)'],['id' => '2','tipo' => 'Onnet (Interno  entre Ext)'],['id' => '3','tipo' => 'DID (Entrante)']);      
        
        $tipo_canal_c3ntro = array(['id' => '1','tipo' => 'Offnet(Salida)'],['id' => '3','tipo' => 'DID (Entrante)'],['id' => '4','tipo' => 'Onnet (Integracion)'],['id' => '5','tipo' => 'DIDFAKE (Integracion)']);  

        foreach($tipo_canal_telmex as $tipo_canal => $value){
            echo $tipo_canal[$value];
        }
        return view('administrador::canales.edit', compact( 'canal', 'distribuidores', 'troncales', 'empresas','tipo_canal_telmex','tipo_canal_c3ntro'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Actualizamos la troncal
         */
        Canales::where( 'id', $id )
                                ->update([
                                    'canal' => $request->input('canal'),
                                    'Troncales_id' => $request->input('Troncales_id'),
                                    'Cat_Distribuidor_id' => $request->input('Cat_Distribuidor_id'),
                                    'Empresas_id' => $request->input('Empresas_id'),
                                ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('canales.index');
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
        return redirect()->route('canales.index');
    }
}
