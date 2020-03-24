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
        $Grabaciones = DB::select( "call SP_Recording(".$Empresas_id.",'$fechainicio','$fechafin')");

        return $Grabaciones;
    }
}
