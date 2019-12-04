<?php

namespace Nimbus\Http\Controllers;

use Nimbus\Config_Empresas;
use Carbon\Carbon;

class ZonaHorariaController extends Controller
{
    public static function zona_horaria( $empresa_id )
    {

        $fecha = date('Y-m-d H:i:s');
        $zona = Config_Empresas::where('Empresas_id', $empresa_id)->get();

        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->timezone( $zona[0]->zona_horaria );
        return $fecha;
    }
}
