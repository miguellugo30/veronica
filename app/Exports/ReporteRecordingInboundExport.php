<?php

namespace Nimbus\Exports;
use Modules\Recording\Http\Controllers\QueryReporteRecordingInboundController;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteRecordingInboundExport implements FromView
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
        $data = QueryReporteRecordingInboundController::query( $this->fecha_inicio, $this->fecha_fin, $this->empresa_id );

        return view('recording::Inbound.show', [
            'Grabaciones' => $data
        ]);
    }
}
