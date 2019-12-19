<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\Exports\ReporteDesgloceExport;
use Maatwebsite\Excel\Facades\Excel;

use Modules\Inbound\Http\Controllers\QueryreportdesgloseController;

class DesgloseLlamadasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('inbound::DesgloseLlamadas.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::DesgloseLlamadas.create');
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
        $desglose = QueryreportdesgloseController::query( $request->dateinicio, $request->datefin, $empresa_id );
        return view('inbound::DesgloseLlamadas.show',compact('desglose'));
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

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
        return Excel::download(new ReporteDesgloceExport($fecha_inicio, $fecha_fin, $empresa_id), 'reporte_desglose_llamadas.xlsx');
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
