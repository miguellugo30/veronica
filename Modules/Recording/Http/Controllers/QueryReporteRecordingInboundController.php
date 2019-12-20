<?php

namespace Modules\Recording\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class QueryReporteRecordingInboundController extends Controller
{
    public static function query($fechainicio, $fechafin, $Empresas_id)
    {
        $Grabaciones =  DB::table('Grabaciones AS GR')
                            ->leftJoin('Cdr_call_center_detalles AS CDD', 'GR.uniqueid', '=', 'CDD.uniqueid')
                            ->join( 'Cdr_Asignacion_Agente AS CAA', 'GR.uniqueid', '=', 'CAA.uniqueid' )
                            ->join( 'Cdr_call_center AS CCC', 'GR.uniqueid', '=', 'CCC.uniqueid' )
                            ->join( 'Agentes AS A', 'CAA.Agentes_id', '=', 'A.id' )
                            ->join( 'Campanas AS C', 'CDD.id_aplicacion', '=', 'C.id' )
                        ->select(
                                'GR.estado AS estado',
                                'C.nombre AS campana',
                                'A.nombre AS agente',
                                'A.extension as extension',
                                'CCC.callerid AS numero',
                                'CDD.fecha_inicio AS inicio',
                                'CDD.fecha_fin AS fin',
                                DB::raw('TIMEDIFF( CDD.fecha_fin, CDD.fecha_inicio ) AS duracion'),
                                'GR.nombre_archivo as escuchar',
                                'GR.id as id'
                            )
                        ->where('GR.Empresas_id', $Empresas_id)
                        ->whereIn('GR.estado', ['Servidor', 'NAS', 'FTP'])
                        ->whereBetween('GR.fecha', [$fechainicio, $fechafin])->get();

        return $Grabaciones;
    }
}
