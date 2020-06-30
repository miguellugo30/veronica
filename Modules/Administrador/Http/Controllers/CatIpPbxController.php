<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Administrador\Http\Requests\PbxRequest;
use App\Cat_IP_PBX;
use App\Cat_NAS;
use App\BaseDatos;
use DB;
use App\Http\Controllers\LogController;

class CatIpPbxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
        * Recuperamos todos los catalogos que esten activos
        */
        $cat_ip_pbx = Cat_IP_PBX::active()->with('BaseDatos')->with('cat_nas')->get();
        return view('administrador::ip_pbx.index', compact('cat_ip_pbx'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
        * Recuperamos todos las NAS que esten activos
        */
        $cat_nas = Cat_NAS::where('activo',1)->get();
        /**
        * Recuperamos todos las Base de datos que esten activos
        */
        $baseDatos = BaseDatos::where('activo',1)->get();

        return view('administrador::ip_pbx.create', compact('cat_nas', 'baseDatos'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PbxRequest $request)
    {
        /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la informacion del formulario
         */
        //$cat = $pbx = Cat_IP_PBX::create(  $request->all() );
        $cat = $pbx = Cat_IP_PBX::create(['ip_pbx' => $request->input('ip_pbx'),
                                          'media_server' => $request->input('media_server'),
                                          'Cat_Base_Datos_id' => $request->input('basedatos')
                                        ]);
        /**
         * Asignamos las categorias al usuario
         */
        if ( $request->input('arr') != NULL ) {
            $data = $request->input('arr');
            for ($i=0; $i < count( $data ); $i++) {
                DB::table('Cat_IP_PBX_Cat_Nas')->insert(
                    ['Cat_IP_PBX_id' => $pbx->id, 'Cat_Nas_id' => $data[$i] ]
                );
            }
        }
         /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Cat_IP_PBX',$mensaje, $cat->id);
        /**
        * Recuperamos todos los catalogos que esten activos
        */
        return redirect()->route('cat_ip_pbx.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administrador::ip_pbx.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la informacion del PBX a editar
         */
        $pbx = Cat_IP_PBX::findOrFail( $id );
        $pbxNas = $pbx->cat_nas->pluck('id')->toArray();
        /**
        * Recuperamos todos las NAS que esten activos
        */
        $cat_nas = Cat_NAS::where('activo',1)->get();
        /**
        * Recuperamos todos las Base de datos que esten activos
        */
        $baseDatos = BaseDatos::where('activo',1)->get();

        return view('administrador::ip_pbx.edit', compact('pbx', 'id', 'cat_nas', 'pbxNas', 'baseDatos'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PbxRequest $request, $id)
    {
        /**
         * Recuperamos la informacion del PBX ha editar
         */
        $pbx = Cat_IP_PBX::findOrFail( $id );
        /**
        * Eliminamos las NAS que tiene el PBX
        */
        DB::table('Cat_IP_PBX_Cat_Nas')->where('Cat_IP_PBX_id', $pbx->id )->delete();
        /**
         * Le asignamos las NAS seleccionada
         */
        $cats = $request->input('arr');

        if ( $cats != NULL ) {
            for ($i=0; $i < count( $cats ); $i++) {
                DB::table('Cat_IP_PBX_Cat_Nas')->insert(
                    ['Cat_Nas_id' => $cats[$i], 'Cat_IP_PBX_id' => $pbx->id]
                );
            }
        }
        /**
         * Actualizamos la informacion del PBX
         */
        Cat_IP_PBX::where( 'id', $id )
                    ->update([
                        'ip_pbx' => $request->input('ip_pbx'),
                        'media_server' => $request->input('media_server'),
                        'Cat_Base_Datos_id' => $request->input('basedatos'),
                    ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Cat_IP_PBX',$mensaje, $id);

        return redirect()->route('cat_ip_pbx.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Cat_IP_PBX::where( 'id', $id )
                ->update([
                    'activo' => '0'
                ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Cat_IP_PBX',$mensaje, $id);

        return redirect()->route('cat_ip_pbx.index');
    }
}
