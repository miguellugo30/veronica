<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\Cat_Plantilla;
use Nimbus\Cat_Campos_Plantillas;
use DB;

class PlantillasController extends Controller
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
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $plantillas = Cat_Plantilla::empresa($empresa_id)->active()->get();

        return view('settings::Plantillas.index', compact('plantillas'));
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
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */

        //$campos = Cat_Campos_Plantillas::get();
        $campos = DB::table('Cat_campos_plantillas')
                    ->select('Cat_campos_plantillas.id', 'Cat_campos_plantillas.nombre')
                    ->join('Campos_plantillas_empresa', 'Campos_plantillas_empresa.fk_cat_campos_plantilla_id', '=', 'Cat_campos_plantillas.id')
                    ->where('Campos_plantillas_empresa.fk_empresas_id', $empresa_id)
                    ->get();

        return view('settings::Plantillas.create', compact('campos'));
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
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('settings::edit');
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
