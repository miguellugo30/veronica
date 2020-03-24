<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Nimbus\Campanas;
use Nimbus\Agentes;
use Nimbus\Grupos;

class ReporteLlamadasAgentesController extends Controller
{
    private $empresa_id;
    /**
     * Constructor para obtener el id empresa
     * con base al usuario que esta usando la sesion
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->empresa_id = Auth::user()->id_cliente;

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos las campanas de la empresa
         */
        $campanas = Campanas::empresa( $this->empresa_id )->active()->get();
        /**
         * Recuperamos los agentes de la empresa
         */
        $agentes = Agentes::empresa( $this->empresa_id )->active()->get();
        /**
         * Recuperamos los grupos de la empresa
         */
        $grupos = Grupos::empresa( $this->empresa_id )->active()->where('tipo_grupo','Agentes')->get();

        return view('inbound::ReporteLlamadasAgentes.index',compact('agentes', 'campanas', 'grupos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtenemos los datos para las calificaciones
         **/
        $llamadas = DB::select( "call SP_Llamadas_Agentes(".$this->empresa_id.",".$request->agente.",".$request->grupo.",".$request->campana.",'$request->dateInicio','$request->dateFin')");

        return view('inbound::ReporteLlamadasAgentes.show',compact('llamadas'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('inbound::edit');
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
