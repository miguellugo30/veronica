<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\DatosFormularios;
use App\Cdr_call_center_detalles;

class CalificarLlamadaController extends Controller
{

    public static function calificarllamada( Request $request )
    {
        /**
         * Obtenemos el id de la campana y fecha inicio de la llamada
         */
        $datoLlamada = Cdr_call_center_detalles::select('id_aplicacion', 'fecha_inicio')->where('uniqueid', $request->uniqueid)->where('aplicacion', 'Campanas')->first();

        //dd( $datoLlamada );

        $dataForm = $request->datosFormulario;

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        $idFormulario = $data['idFormulario'];
        array_shift( $data );
        $idCampos = array_keys( $data );
        $i = 0;
        foreach ($data as $v) {

            DatosFormularios::create([
                'uniqueid' => $request->uniqueid,
                'Calificaciones_id' => $request->id_calificacion,
                'Formularios_id' => $idFormulario,
                'Campos_id' => str_replace( 'campo_', '', $idCampos[$i] ),
                'valor' => $v,
                'fk_campanas_id' => $datoLlamada->id_aplicacion,
                'fecha_registro_llamada' => $datoLlamada->fecha_inicio
           ]);
           $i++;

        }
    }
}
