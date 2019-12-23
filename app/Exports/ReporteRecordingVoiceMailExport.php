<?php

namespace Nimbus\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Nimbus\Grabaciones_buzon_voz;

class ReporteRecordingVoiceMailExport implements FromView
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
        $Grabaciones = Grabaciones_buzon_voz::empresa( $this->empresa_id )->whereBetween( 'fecha_inicio', [ $this->fecha_inicio, $this->fecha_fin ] )->get();

        return view('voicemail::grabacionesVoiceMail.show', [
            'Grabaciones' => $Grabaciones
        ]);
    }
}
