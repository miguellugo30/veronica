<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\Exports\ReporteDesgloceExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

use Modules\Inbound\Http\Controllers\QueryreportdesgloseController;

class DesgloseLlamadasController extends Controller
{
    /**
     * Mostramos el formulario de filtros para el reporte
     */
    public function index()
    {
        return view('inbound::DesgloseLlamadas.index');
    }
    /**
     * Obtenemos la informacion con base a los filtros
     * Y mostramos el resultado
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $desglose = DB::select("call SP_Desgloce_llamadas('$request->dateinicio','$request->datefin',$empresa_id)");
        return view('inbound::DesgloseLlamadas.show',compact('desglose'));
    }
    /**
     * Funcion para poder exportar a Excel
     * el reporte generado
     */
    public function update( $fecha_inicio, $fecha_fin )
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        return Excel::download(new ReporteDesgloceExport($fecha_inicio, $fecha_fin, $empresa_id), 'reporte_desglose_llamadas.xlsx');
    }
}
