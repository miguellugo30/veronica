<?php

namespace Modules\VoiceMail\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReporteRecordingVoiceMailExport;
use Maatwebsite\Excel\Facades\Excel;
use nusoap_client;
use Storage;
use DB;
use Illuminate\Support\Facades\Artisan;
use App\Mail\EnvioBuzonVozMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\LogController;

use App\Grabaciones_buzon_voz;
Use App\Empresas;

class GrabacionesBuzonVozController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        return view('voicemail::grabacionesVoiceMail.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('voicemail::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $Grabaciones = DB::select( "call SP_Buzon_de_voz(".$empresa_id.",'$request->fechaIni','$request->fechaFin')");


        return view('voicemail::grabacionesVoiceMail.show',compact('Grabaciones'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        /**
         * Recuperamos el id empresa de la usuario en sesión
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Recuperamos la grabación ha enviar
         */
        /*
        $grabacion = DB::table('Grabaciones_buzon_voz')
                            ->join( 'Cdr_call_center_detalles', 'Cdr_call_center_detalles.uniqueid', '=', 'Grabaciones_buzon_voz.uniqueid' )
                            ->select(
                                        'Grabaciones_buzon_voz.fecha_inicio',
                                        'Grabaciones_buzon_voz.fecha_fin',
                                        'Grabaciones_buzon_voz.callerid',
                                        'Grabaciones_buzon_voz.nombre_archivo',
                                        DB::raw("IF(Cdr_call_center_detalles.aplicacion='Buzon_Voz', (SELECT Buzon_Voz.nombre FROM Buzon_Voz WHERE Buzon_Voz.id = Cdr_call_center_detalles.id_aplicacion),'') AS buzon")
                                    )
                            ->where('Grabaciones_buzon_voz.id', $id)
                            ->where('Cdr_call_center_detalles.aplicacion', 'Buzon_Voz')
                            ->first();
        */
        $grabacion = DB::select( "call SP_Parametros_buzon(".$id.")");

        /**
         * Inicializamos la conexión al WS
         */
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $cliente =  new  nusoap_client( $wsdl );
        /**
         * Consumimos el WS para bajar la grabación
         */
        $result =  $cliente->call('BajarGrabacionLlamada', array(
                                                                        'empresas_id' => $empresa_id,
                                                                        'id_grabacion' => $id,
                                                                        'tipo' => "Voicemail"
                                                                    ));

        if ( $result['error'] == 1 )
        {
            $archivo = explode( '/', $grabacion->nombre_archivo );
            $ruta = Storage::disk('public')->getAdapter()->getPathPrefix();
            $source = file_get_contents( 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/tmp/'.$archivo[1] );
            file_put_contents( $ruta.'tmp/'.$archivo[1], $source );
            $ruta = Storage::url( 'tmp/'.$archivo[1] ) ;
            $grabacion->ruta = $ruta;

            Mail::to( explode( ';', $request->correos ) )->send(new EnvioBuzonVozMail($grabacion));

            $respuesta = array(
                            'error' => 1,
                            'mensjase' => 'Se ha enviado el correo.'
            );
        }
        else
        {
            $respuesta = array(
                            'error' => 0,
                            'mensjase' => $result['mensaje']."; id de error: ".$id
            );
        }

        return $respuesta;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('voicemail::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update($fecha_inicio, $fecha_fin)
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        return Excel::download(new ReporteRecordingVoiceMailExport($fecha_inicio, $fecha_fin, $empresa_id), 'reporte_grabaciones_buzon_voz.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        /**
         * Obtenemos el id empresa con el usuario
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Obtenemos la ip de PBX que tiene la empresa
         */
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        /**
         * Inicializamos el consumo del PBX
         */
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $cliente =  new  nusoap_client( $wsdl );
        /**
         * Recuperamos las grabaciones a descargar
         */
        $grabaciones = $request->valoresCheck;

        for ($i=0; $i < count( $grabaciones ); $i++) {

            $grabacion = Grabaciones_buzon_voz::where( 'id', $grabaciones[$i] )->get();

            $result = $cliente->call(
                            'EliminarGrabacionLlamada', array
                                                        (
                                                            'empresas_id' => $empresa_id,
                                                            'id_grabacion' => $grabacion[0]->nombre_archivo,
                                                            'tipo' => "Voicemail"
                                                        )
                            );

            if ( $result['error'] == 1 )
            {
                Grabaciones_buzon_voz::where( 'id', $grabaciones[$i] )->update(['estado' => 3]);

                /**
                 * Creamos el logs
                 */
                $mensaje = $result['mensaje'].' con id: '.$grabaciones[$i].' y se actualizo ha BORRADO';
                $log = new LogController;
                $log->store('Eliminación', 'Grabación Buzon de Voz', $mensaje, $grabaciones[$i]);
            }
            else
            {
                Grabaciones_buzon_voz::where( 'id', $grabaciones[$i] )->update(['estado' => 4]);
                 /**
                 * Creamos el logs
                 */
                $mensaje = $result['mensaje'].' con id: '.$grabaciones[$i].' y se actualizo ha ERROR';
                $log = new LogController;
                $log->store('Eliminación', 'Grabación Buzon de Voz', $mensaje, $grabaciones[$i]);
            }
        }
    }

    public function listen(Request $request)
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $infoAudio = explode( '|', $request->grab);

        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $cliente =  new  nusoap_client( $wsdl );

        $result =  $cliente->call('BajarGrabacionLlamada', array(
                                                                        'empresas_id' => $empresa_id,
                                                                        'id_grabacion' => $infoAudio[0],
                                                                        'tipo' => "Voicemail"
                                                                    ));

        $error = $result['error'];

        if ( $result['error'] == 1 )
        {
            $archivo = explode( '/', $infoAudio[0] );
            $ruta = Storage::disk('public')->getAdapter()->getPathPrefix();
            $source = file_get_contents( 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/tmp/'.$archivo[1] );
            file_put_contents( $ruta.'tmp/'.$archivo[1], $source );
            $ruta = Storage::url( 'tmp/'.$archivo[1] ) ;
            $mensaje = "";

            Grabaciones_buzon_voz::where( 'id',  $infoAudio[1] )->update(['estado' => 2]);

        }
        else
        {
            $ruta = '';
            $mensaje = $result['mensaje']."; id de error: ".$infoAudio[1];
        }


        return view('recording::Inbound.reproducir', compact( 'error', 'ruta', 'mensaje' ));
    }

    public function dowloadZip( Request $request )
    {
        /**
         * Limpiamos los archivos del directorio TMP
         **/
        Artisan::call('delete:tmp');
        /**
         * Obtenemos el id empresa con el usuario
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Creamos el directorio donde se guardaran las grabaciones
         */
        Storage::disk('public')->makeDirectory('/tmp/'.$empresa_id);
        /**
         * Obtenemos la ip de PBX que tiene la empresa
         **/
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        /**
         * Inicializamos el consumo del PBX
         **/
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $cliente =  new  nusoap_client( $wsdl );
        /**
         * Recuperamos las grabaciones a descargar
         **/
        $grabaciones = $request->valoresCheck;
        /**
         * Descargamos las grabaciones
         **/
        for ($i=0; $i < count( $grabaciones ); $i++) {

            $grabacion = Grabaciones_buzon_voz::find( $grabaciones[$i] );

            $result =  $cliente->call('BajarGrabacionLlamada', array(
                                                                            'empresas_id' => $empresa_id,
                                                                            'id_grabacion' => $grabacion->nombre_archivo,
                                                                            'tipo' => "Voicemail"
                                                                        ));
            if ( $result['error'] == 1 )
            {
                $archivo = explode( '/', $grabacion->nombre_archivo );
                $ruta = Storage::disk('public')->getAdapter()->getPathPrefix();
                $source = file_get_contents( 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/tmp/'.$archivo[1] );
                file_put_contents( $ruta.'tmp/'.$empresa_id.'/'.$archivo[1], $source );
                $ruta = Storage::url( 'tmp/'.$empresa_id.'/'.$archivo[1] ) ;
            }

        }
        /*
         * CREAMOS EL ZIP CON LOS ARCHIVOS
         $zipper = new \Chumper\Zipper\Zipper;
         $ruta = glob(public_path( '/storage/tmp/'.$empresa_id.'/*' ) );
         $zipper->make('storage/tmp/grabaciones_buzon_voz_'.$empresa_id.'.zip')->add( $ruta )->close();
         $zipper->close();
         **/
        /**
         * Borramos el directorio temporal
         **/
        Storage::disk('public')->deleteDirectory('/tmp/'.$empresa_id);
        return 'storage/tmp/grabaciones_buzon_voz_'.$empresa_id.'.zip';
    }
}
