<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Nimbus\Cat_Estado_Agente;
use Nimbus\Agentes;
use Nimbus\Grupos;

class ReporteProductividadAgentesController extends Controller
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
         * Recuperamos los agentes de la empresa
         */
        $agentes = Agentes::empresa( $this->empresa_id )->active()->get();
        /**
         * Recuperamos los grupos de la empresa
         */
        $grupos = Grupos::empresa( $this->empresa_id )->active()->where('tipo_grupo','Agentes')->get();
                /**
         * Recuperamos los grupos de la empresa
         */
        $estados = Cat_Estado_Agente::active()->get();

        return view('inbound::ReporteProductividadAgentes.index',compact('agentes', 'grupos', 'estados'));
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
        set_time_limit(0);
        ini_set('memory_limit', -1);
        /**
         * Obtenemos la productividad del agente o del grupo de agentes
         **/
        $llamadas = DB::select("CALL SP_Productividad_Agentes(".$request->agente.",".$request->grupo.",'$request->dateInicio','$request->dateFin')");
        //dd( $llamadas );
        $data = $this->procesarInfo($llamadas);
        //dd( $data );

        $estados = array(
                            'Tiempo Disponible' => 2,
                            'Tiempo Logueo' => 11,
                            'Tiempo no disponible' => 1,
                            'Tiempo marcador manual' => 10,
                            'Tiempo llamada programada' => 5,
                            'Tiempo en llamada inbound' => 8,
                            'Tiempo definiendo llamada inbound' => 12,
                            'Tiempo total inbound' => 0,
                            'Tiempo en llamada Outbound' => 4,
                            'Tiempo definiendo llamada Outbound' => 13,
                            'Tiempo total Outbound' => 0,
                        );

        return view('inbound::ReporteProductividadAgentes.show',compact('data', 'estados'));
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
    public function update(Request $request, $id)
    {
        //
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

    public function procesarInfo( $data )
    {
        $v = get_object_vars( $data[0] );
        //$idAgente = 0;
        $w = [];
        $d = [];
        $idAgente = $v['fk_agentes_id'];
        $info = [];
        $estados = [];

        for ($j=0; $j < count( $data ); $j++)
        {
            $v = get_object_vars( $data[$j] );

            if ( $idAgente == $v['fk_agentes_id'])
            {
                array_push( $w, $v );
            }
            else
            {
                array_push( $d, $w );
                $w = [];
                array_push( $w, $v );
                $idAgente = $v['fk_agentes_id'];
            }

            if ( $j ==  ( count( $data ) -1 ) )
            {
                array_push( $d, $w );
            }
        }

        for ($i=0; $i < count( $d ); $i++)
        {
            for ($j=0; $j < count( $d[$i] ); $j++)
            {

                $v = $d[$i][$j];

                $z = array(
                            'id_agente' => $v['id_agente'],
                            'nombre' => $v['nombre'],
                            'Recibidas' => $v['Recibidas'],
                            'Contestadas' => $v['Contestadas'],
                            'omitidas' => $v['omitidas'],
                        );

                if ( $j == 0 )
                {
                    $w = array(
                            'Estadoid' => 12,
                            'Estado' => 'Tiempo Definiendo Llamada',
                            'Eventos' => 0,
                            'Promedio' => $v['Promedio_definiendo_llamada'],
                            'Total' => $v['Total_definiendo_llamada']
                    );
                    array_push( $estados, $w );
                }

                $y = array(
                            'Estadoid' => (int)$v['Estadoid'],
                            'Estado' => $v['Estado'],
                            'Eventos' => $v['Eventos'],
                            'Promedio' => $v['Promedio'],
                            'Total' => $v['Total']
                        );

                array_push( $estados, $y );
            }

            $m = array( 'data' => $z, 'estados' => $estados );

            array_push( $info, $m );

            $estados = [];
        }
        return $info;
    }

}
