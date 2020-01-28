<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

use Nimbus\Cdr_call_center;

class ACDController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('inbound::ACD.index');
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
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $cdr = DB::select("call SP_Metricas_ACD_TEST('$empresa_id','$request->dateInicio','$request->dateFin')");
        $array = $cdr[0]->JSON;
        $array = explode(",",$array);
        $todas = str_replace('"','',explode('":"',$array[0]));
        $contestadas = str_replace('"','',explode('":"',$array[1]));
        $nocontestadas = str_replace('"','',explode('":"',$array[2]));
        $desviadas = str_replace('"','',explode('":"',$array[3]));
        $promediodellamada = str_replace('"','',explode('":"',$array[4]));
        $promediotiempoespera = str_replace('"','',explode('":"',$array[5]));
        $promedioabandono = str_replace('}','',str_replace('"','',explode('":"',$array[6])));

        return view('inbound::ACD.show', compact( 'todas','contestadas','nocontestadas','desviadas','promediodellamada','promediotiempoespera','promedioabandono' ));

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
    public function update( $fecha_inicio, $fecha_fin )
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        return Excel::download(new ReporteACDExport($fecha_inicio, $fecha_fin, $empresa_id), 'reporte_ACD.xlsx');
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
