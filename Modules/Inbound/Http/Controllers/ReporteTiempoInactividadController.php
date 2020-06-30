<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Agentes;
use App\Grupos;
use App\Eventos_Agentes;

class ReporteTiempoInactividadController extends Controller
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
         * Recuperamos los eventos de los agentes de la empresa
         */
        $eventos = Eventos_Agentes::empresa( $this->empresa_id )->active()->get();

        return view('inbound::ReporteTiempoInactividad.index', compact('agentes', 'grupos', 'eventos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::ReporteTiempoInactividad.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
         /**
         * Recuperamos los eventos de los agentes de la empresa
         */
        $eventos = Eventos_Agentes::empresa( $this->empresa_id )->active()->get();
        /**
         * Obtenemos la productividad del agente o del grupo de agentes
         **/
        $tiempos = DB::select("CALL SP_Tiempo_No_Disponible_Agente(".$request->agente.",".$request->grupo.",'$request->dateInicio','$request->dateFin')");

        $data = $this->procesarInfo($tiempos);

        return view('inbound::ReporteTiempoInactividad.show',compact('data', 'eventos'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::ReporteTiempoInactividad.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('inbound::ReporteTiempoInactividad.edit');
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

    public function  procesarInfo( $data )
    {
        $v = get_object_vars( $data[0] );
        //$idAgente = 0;
        $w = [];
        $d = [];
        $idAgente = $v['usuario'];
        $info = [];
        $estados = [];

        for ($j=0; $j < count( $data ); $j++)
        {
            $v = get_object_vars( $data[$j] );

            if ( $idAgente == $v['usuario'])
            {
                array_push( $w, $v );
            }
            else
            {
                array_push( $d, $w );
                $w = [];
                array_push( $w, $v );
                $idAgente = $v['usuario'];
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

                $z = array( 'usuario' => $v['usuario'] );

                $y = array(
                            'nombre' => $v['nombre'],
                            'Tiempo_estado_total' => $v['Tiempo_estado_total'],
                            'Tiempo_estado_promedio' =>  $v['Tiempo_estado_promedio'],
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
