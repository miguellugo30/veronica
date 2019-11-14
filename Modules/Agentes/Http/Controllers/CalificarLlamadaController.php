<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\DatosFormularios;

class CalificarLlamadaController extends Controller
{
    public static function calificarllamada( Request $request )
    {

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
                'valor' => $v
           ]);
           $i++;

        }
    }
}
