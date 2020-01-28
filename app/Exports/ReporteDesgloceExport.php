<?php

namespace Nimbus\Exports;

use Modules\Inbound\Http\Controllers\QueryreportdesgloseController;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ReporteDesgloceExport implements FromView
{

    protected $fecha_inicio;
    protected $fecha_fin;
    protected $empresa_id;
    public function __construct( $fecha_inicio, $fecha_fin, $empresa_id )
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->empresa_id = $empresa_id;
    }

    public function view(): View
    {
        $data = DB::select("call SP_Desgloce_llamadas('$this->fecha_inicio','$this->fecha_fin',$this->empresa_id)");
        return view('inbound::DesgloseLlamadas.show', [
            'desglose' => $data
        ]);
    }
}
