<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_IP_PBX;
use Nimbus\Cat_NAS;
use DB;

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
        $cat_ip_pbx = Cat_IP_PBX::where('activo',1)->get();
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
        return view('administrador::ip_pbx.create', compact('cat_nas'));
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
        $pbx = Cat_IP_PBX::create(  $request->all() );
        /**
         * Asignamos las categorias al usuario
         */
        $data = $request->input('arr');
        for ($i=0; $i < count( $data ); $i++) {
            DB::table('Cat_IP_PBX_Cat_Nas')->insert(
                ['Cat_IP_PBX_id' => $pbx->id, 'Cat_Nas_id' => $data[$i] ]
            );
        }
        $cats_nas = $pbx->cat_nas;
        /**
        * Recuperamos todos los catalogos que esten activos
        */
        $cat_ip_pbx = Cat_IP_PBX::where('activo',1)->get();
        return view('administrador::ip_pbx.index', compact('cat_ip_pbx'));
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
        return view('administrador::ip_pbx.edit');
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
        //
    }
}
