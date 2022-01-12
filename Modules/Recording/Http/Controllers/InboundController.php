<?php

namespace Modules\Recording\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Recording\Http\Controllers\QueryReporteRecordingInboundController;
use App\Exports\ReporteRecordingInboundExport;
use Maatwebsite\Excel\Facades\Excel;
use nusoap_client;
use Storage;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LogController;

use App\Empresas;
use App\Grabaciones;

class InboundController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('recording::Inbound.index');

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
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $Grabaciones = QueryReporteRecordingInboundController::query($request->fechaIni, $request->fechaFin, $empresa_id );

        return view('recording::Inbound.show',compact('Grabaciones'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function listen(Request $request)
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $infoAudio = explode( '|', $request->grab);

        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $cliente =  new  nusoap_client( $wsdl );
        //dd($wsdl);
        $result =  $cliente->call('BajarGrabacionLlamada', array(
                                                                        'empresas_id' => $empresa_id,
                                                                        'id_grabacion' => $infoAudio[0],
                                                                        'tipo' => "Inbound"
                                                                    ));

        $error = $result['error'];

        if ( $result['error'] == 1 )
        {
            $archivo = explode( '/', $infoAudio[0] );
            $ruta = Storage::disk('public')->getAdapter()->getPathPrefix();
            //dd($ruta);
            $source = file_get_contents( 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/tmp/'.$archivo[1] );
            Storage::put('tmp'.$archivo[1], $source);
            //file_put_contents( $ruta.'tmp/'.$archivo[1], $source );
            $ruta = Storage::url( 'tmp/'.$archivo[1] ) ;
            $mensaje = "";
        }
        else
        {
            $ruta = '';
            $mensaje = $result['mensaje']."; id de error: ".$infoAudio[1];
        }
        return view('recording::Inbound.reproducir', compact( 'error', 'ruta', 'mensaje' ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function dowloadZip( Request $request )
    {
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
         */
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        /**
         * Inicializamos el consumo del PBX
         */
        $wsdl = 'http://'.$pbx->Config_Empresas->ms->ip_pbx.'/ws-ms/index.php';
        $cliente =  new  nusoap_client( $wsdl );
         /**
         * Limpiamos los archivos del directorio TMP
         */
        Artisan::call('delete:tmp');
        /**
         * Recuperamos las grabaciones a descargar
         */
        $grabaciones = $request->valoresCheck;
        /**
         * Descargamos las grabaciones
         */
        for ($i=0; $i < count( $grabaciones ); $i++) {

            $grabacion = Grabaciones::find( $grabaciones[$i] );

            $result =  $cliente->call('BajarGrabacionLlamada', array(
                                                                            'empresas_id' => $empresa_id,
                                                                            'id_grabacion' => $grabacion->nombre_archivo,
                                                                            'tipo' => "Inbound"
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
         $zipper->make('storage/tmp/grabaciones_'.$empresa_id.'.zip')->add( $ruta )->close();
         $zipper->close();
         **/
        /**
         * Borramos el directorio temporal
         */
        Storage::disk('public')->deleteDirectory('/tmp/'.$empresa_id);
        return 'storage/tmp/grabaciones_'.$empresa_id.'.zip';
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
        return Excel::download(new ReporteRecordingInboundExport($fecha_inicio, $fecha_fin, $empresa_id), 'reporte_recording_inbound.xlsx');
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

            $grabacion = Grabaciones::find( $grabaciones[$i] );

            $result = $cliente->call(
                            'EliminarGrabacionLlamada', array
                                                        (
                                                            'empresas_id' => $empresa_id,
                                                            'id_grabacion' => $grabacion->nombre_archivo,
                                                            'tipo' => "Inbound"
                                                        )
                            );

            if ( $result['error'] == 1 )
            {
                Grabaciones::where( 'id', $grabaciones[$i] )->update(['estado' => 'Borrado']);
                /**
                 * Creamos el logs
                 */
                $mensaje = $result['mensaje'].' con id: '.$grabaciones[$i].' y se actualizo ha BORRADO';
                $log = new LogController;
                $log->store('Eliminación', 'Grabación', $mensaje, $grabaciones[$i]);
            }
            else
            {
                Grabaciones::where( 'id', $grabaciones[$i] )->update(['estado' => 'Error']);
                 /**
                 * Creamos el logs
                 */
                $mensaje = $result['mensaje'].' con id: '.$grabaciones[$i].' y se actualizo ha ERROR';
                $log = new LogController;
                $log->store('Eliminación', 'Grabación', $mensaje, $grabaciones[$i]);
            }
        }
    }
}
