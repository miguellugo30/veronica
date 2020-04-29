<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

use Nimbus\Campanas;

class ACDController extends Controller
{
    private $empresa_id;
    /**
     * Constructor para obtener el id empresa
     * con base al usuario que esta usando la sesion
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->empresa_id = Auth::user()->id_cliente;

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos las campanas de la empresa
         */
        $campanas = Campanas::empresa( $this->empresa_id )->active()->with('Campanas_Configuracion')->get();

        return view('inbound::ACD.index', compact('campanas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Declaramos las variables que se utlizara para los datos
         * que solo se usan cuando elija una campana
         */
        $datosCampana = '';
        $tendenciaLlamadas = '';
        $calificaciones = '';
        $reportes = $request->data;
        /**
         * Obtenemos los datos del CDR
         **/
        $cdr = DB::select("call SP_Metricas_ACD('$this->empresa_id','$request->dateInicio','$request->dateFin')");
        $array = json_decode( $cdr[0]->JSON );
        /**
         * Obtenemos los datos para los niveles de servicio
         **/
        if ( $reportes['nivel-servicio'] == 1 )
        {
            $nivel_servicio = $this->array_nivel_servicio( DB::select( "call SP_Nivel_de_Servicio(".$request->campana.",'$request->dateInicio','$request->dateFin',".$request->tiempoEvaluacion.")") );
        }

        if( $request->campana != 0 )
        {
            /**
             * Obtenemos los datos para la tendencia de llamada
             **/
            if ( $reportes['tendencia'] == 1 )
            {
                $datosCampana = $this->array_desgloce_datos_tendencia(  DB::select( "call SP_Desgloce_Datos(".$request->campana.",'$request->dateInicio','$request->dateFin')") );

                $tendenciaLlamadas = DB::select( "call SP_Tendencia_Llamadas(".$request->campana.",'$request->dateInicio','$request->dateFin')");
                $tendenciaLlamadas = json_decode( $tendenciaLlamadas[0]->JSON );
            }
            /**
             * Obtenemos los datos para las calificaciones
             **/
            if ( $reportes['calificaciones'] == 1 )
            {
                $calificaciones = DB::select( "call SP_Calificaciones_Llamadas(".$request->campana.",'$request->dateInicio','$request->dateFin')");
            }
        }

        return view('inbound::ACD.show', compact( 'array', 'nivel_servicio', 'datosCampana', 'tendenciaLlamadas', 'calificaciones', 'reportes' ));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('inbound::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update( $fecha_inicio, $fecha_fin )
    {
        //$user = Auth::user();
        //$empresa_id = $user->id_cliente;
        //return Excel::download(new ReporteACDExport($fecha_inicio, $fecha_fin, $empresa_id), 'reporte_ACD.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Funcion para completar la informacion de llamadas por hora,
     * reporte de nivel de servicio
     */
    public function array_nivel_servicio($nivel_servicio)
    {
        $array = [];
        /**
         * Si se tiene valores se ingresa al proceso
         * Si no se regresa el arreglo vacio
         */
        if( $nivel_servicio != NULL )
        {
            /**
             * Recorremos las 24 horas
             */
            for ($i = 0; $i < 24; $i++)
            {
                /**
                 * Obtenemos los valores recuperados de la base de datos
                 */
                foreach ($nivel_servicio as $nivel)
                {
                    /**
                     * Si la hora ( $i ), es igual al valor del rango del tiempo
                     * se insertan los valores en el array, si no solo se crea una bandera
                     * para poder insertar valores en 0
                     */
                    if ( $i == $nivel->Rango_de_Tiempo )
                    {
                        $bandera = 1;

                        $a = [
                            'rango_tiempo' => ( $i >= 10 ) ? $i.":00 - ".($i+1).":00" : "0".$i.":00 - "."0".($i+1).":00",
                            'Total_de_Llamadas' => (int)$nivel->Total_de_Llamadas,
                            'Total_Llamadas_Correctas' => (int)$nivel->Total_Llamadas_Correctas,
                            'Promedio_en_Espera' => $nivel->Promedio_en_Espera,
                            'Service_Level' => $nivel->Service_Level,
                        ];

                        array_push($array, $a);

                        break;
                    }
                    else
                    {
                        $bandera = 0;
                    }
                }//foreach
                /**
                 * Si tenemos la bandare en 0, se insertar valores en 0, dentro del array,
                 * correspondiente a la hora
                 */
                if ( $bandera == 0 )
                {
                    $a = [
                        'rango_tiempo' => ( $i >= 10 ) ? $i.":00 - ".($i+1).":00" : "0".$i.":00 - "."0".($i+1).":00",
                        'Total_de_Llamadas' => 0,
                        'Total_Llamadas_Correctas' => 0,
                        'Promedio_en_Espera' => '00:00:00',
                        'Service_Level' => '100%',
                    ];
                    array_push($array, $a);
                }
            }
        }
        return $array;
    }
    /**
     * Función para completar la información de llamadas por hora,
     * reporte de nivel de servicio
     */
    public function array_desgloce_datos_tendencia($tendencia)
    {
        $array = [];
        /**
         * Si se tiene valores se ingresa al proceso
         * Si no se regresa el arreglo vacio
         */
        if( $tendencia != NULL )
        {
            /**
             * Recorremos las 24 horas
             */
            for ($i = 0; $i < 24; $i++)
            {
                /**
                 * Obtenemos los valores recuperados de la base de datos
                 */
                foreach ($tendencia as $nivel)
                {
                    $data = json_decode( $nivel->JSON );
                    /**
                     * Si la hora ( $i ), es igual al valor del rango del tiempo
                     * se insertan los valores en el array, si no solo se crea una bandera
                     * para poder insertar valores en 0
                     */
                    if ( $i == $data->Rango_de_tiempo )
                    {
                        $bandera = 1;
                        $a = [];

                        foreach ($data as $key => $value)
                        {
                            if ( $key == 'Rango_de_tiempo' )
                            {
                                $a[$key] =  ( $i >= 10 ) ? $i.":00 - ".($i+1).":00" : "0".$i.":00 - "."0".($i+1).":00";
                            }
                            else
                            {
                                $a[$key] =  $value;
                            }
                        }

                        array_push($array, $a);

                        break;
                    }
                    else
                    {
                        $bandera = 0;
                    }
                }//foreach
                /**
                 * Si tenemos la bandare en 0, se insertar valores en 0, dentro del array,
                 * correspondiente a la hora
                 */
                if ( $bandera == 0 )
                {
                    $a = [
                        'Rango_de_tiempo' => ( $i >= 10 ) ? $i.":00 - ".($i+1).":00" : "0".$i.":00 - "."0".($i+1).":00",
                        'Campana' => 0,
                        'Total_de_Llamadas' => 0,
                        'Llamadas_Contestadas' => 0,
                        'Promedio_en_Espera' => '00:00:00',
                        'Promedio_Duracion' => '00:00:00',
                        'Llamadas_Abandonadas' => 0,
                        'Promedio_Abandono' => '00:00:00',
                        'Llamadas_Desviadas' => '0',
                    ];
                    array_push($array, $a );
                }
            }
        }
        return $array;
    }
}
