<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\Registros_Eventos_Agentes;

class LogRegistroEventosController extends Controller
{
    /**
     * Registro nuevo evento.
     */
    public static function registro_evento( $id_Agente, $id_Evento)
    {
        return Registros_Eventos_Agentes::create([
                        'fecha_inicio' => Carbon::now(),
                        'Eventos_Agentes_id' => $id_Evento,
                        'Agentes_id' =>  $id_Agente
                    ]);
    }

    public static function actualiza_evento($id_Agente, $id_Evento_Registro, $cierre)
    {
        Registros_Eventos_Agentes::where('Agentes_id', $id_Agente)
                                 ->where( 'id', $id_Evento_Registro)
                                 ->update(['fecha_fin' => Carbon::now(), 'cierre_correcto' => (int)$cierre]);
    }
}
