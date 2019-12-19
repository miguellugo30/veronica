<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class QueryreportdesgloseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public static function query($fechainicio, $fechafin, $Empresas_id)
    {
        $historico = DB::table('Cdr_call_center AS A')
                            ->join('Cdr_campanas_log AS B', function ($join) {
                                $join->on('A.uniqueid', '=', 'B.callid')
                                ->on('A.hangup', '=', 'B.event');
                            })
                            ->join( 'Campanas AS C', 'B.queuename', '=', 'C.id' )
                            ->leftJoin('Agentes AS D', 'B.agent', '=', 'D.id')
                            ->leftJoin('Cdr_Asignacion_Agente AS E', 'A.uniqueid', '=', 'E.uniqueid')
                    ->select(
                                'A.uniqueid',
                                'A.callerid',
                                'A.calledid',
                                'A.fecha_inicio',
                                'E.fecha_respuesta',
                                'A.fecha_fin',
                                'E.fecha_calificacion',
                                'B.event',
                                'C.nombre AS campana',
                                'D.nombre AS agente',
                                DB::raw('TIMEDIFF( E.fecha_respuesta, A.fecha_inicio ) AS espera'),
                                DB::raw('TIMEDIFF( A.fecha_fin, A.fecha_inicio ) duracion'),
                                DB::raw('TIMEDIFF( E.fecha_calificacion, A.fecha_fin ) AS definicion')
                            )
                    ->whereBetween('A.fecha_inicio', [$fechainicio, $fechafin])
                    ->where('A.Empresas_id', $Empresas_id)->get();

        return $historico;
    }


}
