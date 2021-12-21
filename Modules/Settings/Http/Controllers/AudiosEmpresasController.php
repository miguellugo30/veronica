<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use nusoap_client;

use App\Http\Controllers\LogController;
use App\Audios_Empresa;
use App\User;
use Storage;
use App\Empresas;
use File;
use Modules\Settings\Http\Requests\AudiosRequest;


class AudiosEmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $audios = Audios_Empresa::empresa($empresa_id)->active()->get();

        return view('settings::AudiosEmpresa.index',compact('audios'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('settings::AudiosEmpresa.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(AudiosRequest $request)
    {
        /** Obtener los datos del usuario logeado **/
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

       /**  Obtener los datos del campo file definido en el formulario **/
       $file = $request->file('file');

       /** Obtener el nombre del archivo **/
       $aud_nom = $file->getClientOriginalName();
       $dir_audios = "/audios/".$empresa_id;
       /** Crear la Ruta en Storage */
       if(!File::exists($dir_audios))
           Storage::makeDirectory($dir_audios);

       /** Colocar en el Directorio WEB SERVER **/
       $request->file('file')->storeAs($dir_audios, $file->getClientOriginalName());
        /** Crear el logs    */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'User',$mensaje, $user->id);
        /**
         * Subimos el archivo al media server
         */
        //$pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://media.veronicacc.com/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );

        $client->call('SubirArchivo', array(
                                                'empresas_id' => $empresa_id,
                                                'id_grabacion' => $aud_nom
                                            ));
        /** Insertar registro en Audios **/
          Audios_Empresa::create(
            [
                'nombre' => $request->input('nombre'),
                'descripcion'   => $request->input('descripcion'),
                'ruta' =>  'Grabaciones_'.$empresa_id."/".$request->input('ruta') ,
                'Empresas_id'   => $empresa_id
            ]
          );

        /** Mostrar principal  */
        return redirect()->route('Audios.index');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Obtenemos la grabacion a usar
         */
        $audio = Audios_Empresa::find( $id );
        /**
         * Obtener los datos del usuario logeado
         * **/
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Descargamos el archivo al media server
         */
        $pbx = Empresas::empresa($empresa_id)->active()->with('Config_Empresas')->with('Config_Empresas.ms')->get()->first();
        $wsdl = 'http://media.veronicacc.com/ws-ms/index.php';
        $client =  new  nusoap_client( $wsdl );

        $result = $client->call('BajarArchivo', array(
                                                'empresas_id' => $empresa_id,
                                                'id_grabacion' => $audio->ruta
                                            ));
        $error = $result['error'];

        if ( $result['error'] == 1 )
        {
            $archivo = explode( '/',  $audio->ruta );
            $ruta = Storage::disk('public')->getAdapter()->getPathPrefix();
            $source = file_get_contents( 'http://media.veronicacc.com/ws-ms/tmp/'.$archivo[1] );
            file_put_contents( $ruta.'tmp/'.$archivo[1], $source );
            $ruta = Storage::url( 'tmp/'.$archivo[1] ) ;
            $mensaje = "";
        }
        else
        {
            $ruta = '';
            $mensaje = $result['mensaje']."; id de error: ".$audio->ruta;
        }
        return view('settings::AudiosEmpresa.show', compact( 'error', 'ruta', 'mensaje' ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('settings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(AudiosRequest $request, $id)
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
        Audios_Empresa::where('id',$id)->update(['activo'=>0]);

        return redirect()->route('Audios.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'User', $mensaje, $id);

    }

}
