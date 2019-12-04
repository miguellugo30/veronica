<?php

namespace Modules\Recording\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Nimbus\User;
use Nimbus\Agentes;
//use Nimbus\Cat_Extensiones;
use Nimbus\Campanas;
use Nimbus\Calificaciones;
use Nimbus\Sub_Calificaciones;
use Illuminate\Support\Facades\Auth;
use Nimbus\Empresas;
use Nimbus\Grabaciones;
use Nimbus\Formularios;
use Nimbus\Miembros_Campana;
use Nimbus\Grupos;
//use Nimbus\Grupo_Calificaciones;
use DB;
use Session;
use nusoap_client;

class InboundController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos los datos del usuario Logueado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $campanas = Campanas::active()->where('Empresas_id',$empresa_id)->where('tipo_marcacion','Inbound')->get();
        Session::flash('campanas', $campanas);
        return view('recording::Inbound.index',compact('campanas'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('recording::Inbound.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*
        //$campana_id = $request->input('campana');
        $campanas = Session::get('campanas');
        $campana_id = $request->all();
        $miembros = Miembros_Campana::where('Campanas_id',$campana_id)->get();

        foreach ($miembros as $miembro){

            $nombres[] = Agentes::where('id',$miembro->Agentes_id)->get();

        }
            Session::flash('nombres', $nombres);
            return $nombres;
            //return view('recording::Inbound.index',compact('campanas','nombres'));
        */
            $user = User::find( Auth::id() );
            $empresa_id = $user->id_cliente;
            $fechaI = $request->input('fechaIni');
            $fechaF = $request->input('fechaFin');

            $Grabaciones =  DB::select("SELECT GR.estado AS estado, C.nombre AS campana, A.nombre AS agente, A.extension as extension, CCC.callerid AS numero, CDD.fecha_inicio AS inicio, CDD.fecha_fin AS fin,
            TIMEDIFF( CDD.fecha_fin, CDD.fecha_inicio ) AS duracion, GR.nombre_archivo as escuchar
            FROM Grabaciones GR
            RIGHT JOIN Cdr_call_center_detalles CDD ON (GR.uniqueid = CDD.uniqueid)
            JOIN `Cdr_Asignacion_Agente` CAA ON (GR.uniqueid = CAA.uniqueid)
            JOIN  `Cdr_call_center` CCC ON (GR.uniqueid = CCC.uniqueid)
            JOIN Agentes A ON (CAA.Agentes_id = A.id)
            JOIN Campanas C ON (CDD.id_aplicacion = C.id)
            WHERE GR.Empresas_id = $empresa_id AND GR.fecha BETWEEN '$fechaI' AND '$fechaF'");

            return view('recording::Inbound.show',compact('Grabaciones','user'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('recording::Inbound.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('recording::Inbound.edit');
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

    public function getAgentes($campana_id)
    {
        $miembros = DB::table("Miembros_Campanas")->where('Campanas_id',$campana_id)->get('Agentes_id');
        foreach ($miembros as $miembro){

            $nombres[] = Agentes::where('id',$miembro->Agentes_id)->pluck('nombre');
        }
        return $nombres;
    }

    public function getExtensiones($agente_id)
    {
        $agentes = Agentes::where('nombre',$agente_id)->pluck('extension');

        return $agentes;
    }

    public function getCalificaciones($campana_id)
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $grupos_id = Campanas::active()->where('tipo_marcacion','Inbound')->where('id',$campana_id)->where('Empresas_id',$empresa_id)->pluck('Grupos_id');
        $idCalif = DB::table("Grupo_Calificaciones")->where('Grupos_id',$grupos_id)->get('Calificaciones_id');
        foreach ($idCalif as $idC){
            $nombreCalificaciones[] = Calificaciones::active()->where('id',$idC->Calificaciones_id)->pluck('nombre');
        }
        return $nombreCalificaciones;

    }

    public function getGrabaciones(Request $request,$campana_id)
    {   $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $fechaI = $request->input('fechaIni');
        $fechaF = $request->input('fechaFin');

        $grabaciones = Grabaciones::where('tipo','Inbound')->where('Empresas_id',$empresa_id)->whereBetween('fecha',[$fechaI,$fechaF])->get();

        foreach ($grabaciones as $grabacion) {

            $grabacionesnombre[] = Campanas::active()->where('tipo_marcacion','Inbound')->where('Empresas_id',$empresa_id)->where('id_grabacion',$grabacion->id)->get();

        }
        $i = 0;
        foreach ($grabacionesnombre as $agentesnombre) {
            $i++;
            if (isset($grabacionesnombre[$i-1][0]['id'])) {
                $agentesnombre[] = Miembros_Campana::where('Campanas_id',$grabacionesnombre[$i-1][0]['id'])->get();
            }
        }

        return view('recording::Inbound.show',compact('grabaciones','grabacionesnombre','agentesnombre'));
    }

    public function getGrabacion(Request $request,$nom_audio)
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $wsdl = 'http://10.255.242.136/ws-ms/index.php';

        $client =  new  nusoap_client( $wsdl );

        $result = $client->call('BajarArchivo', array(
            'empresas_id' => $empresa_id,
            'id_grabacion' => $nom_audio
        ));
    }

}


/*
  $grabaciones = Grabaciones::where('tipo','Inbound')->where('Empresas_id',$empresa_id)->whereBetween('fecha',[$fechaI,$fechaF])->get();

            foreach ($grabaciones as $grabacion) {

                        $grabacionesnombre[] = Campanas::active()->where('tipo_marcacion','Inbound')->where('Empresas_id',$empresa_id)->where('id_grabacion',$grabacion->id)->get();
            }

            $i = 0;
            foreach ($grabacionesnombre as $agentesnombre) {

                $i++;
                if (isset($grabacionesnombre[$i-1][0]['id'])) {
                    $nombreagentes[] = Miembros_Campana::where('Campanas_id',$grabacionesnombre[$i-1][0]['id'])->get();
                }
            }

            $j = 0;
            foreach ($nombreagentes as $agente) {
                $j++;
                if (isset($nombreagentes[$j-1][0]['Agentes_id'])) {
                    $agentes[] = Agentes::active()->where('Empresas_id',$empresa_id)->where('tipo_licencia','Inbound')->where('id',$nombreagentes[$j-1][0]['Agentes_id'])->get();
                }
            }
 */
