<?php

namespace Nimbus\Http\Controllers;

use Nimbus\Config_Empresas;
use Carbon\Carbon;
use DB;

class ZonaHorariaController extends Controller
{
    /**
     * Zona horaria por empresa
     */
    public static function zona_horaria( $empresa_id )
    {
        $zona = DB::select("CALL SP_Obten_Zona_Horaria( NULL ,".$empresa_id.")");

        return $zona->first()->zona_horaria;

        //return Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now($zona[0]->zona_horaria))->toDateTimeString();
    }
    /**
     * Zona horaria por agente
     */
    public static function zona_horaria_agente( $agente )
    {
        $zona = DB::select("CALL SP_Obten_Zona_Horaria(".$agente.", NULL)");
        return $zona->first()->zona_horaria;
        //return Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now($zona[0]->zona_horaria))->toDateTimeString();
    }
}
