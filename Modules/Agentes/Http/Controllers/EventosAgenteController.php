<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;

use Nimbus\Miembros_Campana;
use Nimbus\Agentes;

class EventosAgenteController extends Controller
{
    /**
     * Funcion para colgar llamada
     */
    public function colgar( Request $request )
    {
        EventosAmiController::colgar_llamada( $request->canal );
    }
    /**
     * Funcion para poner como no disponible a un agente
     */
    public function no_disponible( Request $request )
    {
        $evento = LogRegistroEventosController::registro_evento( auth()->guard('agentes')->id(), $request->no_disponible );
        Miembros_Campana::where( 'membername', auth()->guard('agentes')->id() )->update(['Paused' => 1]);
        Agentes::where( 'id', auth()->guard('agentes')->id() )->update(['Cat_Estado_Agente_id' => 3]);

        $agente = auth()->guard('agentes')->id();

        return view('agentes::cronometro', compact( 'agente', 'evento' ));
    }
    /**
     * Funcion para poner como  disponible a un agente
     */
    public function agente_disponible( Request $request )
    {
        LogRegistroEventosController::actualiza_evento( $request->agente, $request->evento );
        Miembros_Campana::where( 'membername', $request->agente )->update(['Paused' => 0]);
        Agentes::where( 'id', $request->agente )->update(['Cat_Estado_Agente_id' => 2]);

    }
}
