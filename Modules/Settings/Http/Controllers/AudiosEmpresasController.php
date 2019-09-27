<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Nimbus\Http\Controllers\LogController;
use Nimbus\Audios_Empresa;
use Nimbus\User;
use Storage;
use File;


class AudiosEmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $audios = Audios_Empresa::active()->get();
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
    public function store(Request $request)
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
       ## storage/app/public/audios/empresa_id/ */
       Storage::disk('public')->put($dir_audios."/".$aud_nom, \File::get($file));
       ## Storage::disk('local')->put($dir_audios."/".$aud_nom,  \File::get($file));

       //dd($dir_audios);

        /** Crear el logs    */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'User',$mensaje, $user->id);

        ## OBTENER DEL Modelo FALTA
        ## $ip_pbx

        /** Consumir WS desde el MS para enviar el audio **/
        $url = '10.255.242.136/audios/upload_audios.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "empresa_id=".$empresa_id."&accion=1"."&id=" . $aud_nom);
        $remote_server_output = curl_exec($ch);
        $error = curl_errno($ch);
        curl_close ($ch);

   // dd($remote_server_output);
        /** Si respuesta es 1 */
      //  if ($remote_server_output == 1) {

            /*
           $ruta_media = "call_center/Grabaciones_" . $empresa_id . "/" . $id_audio;
           $audio = explode("-", $id_audio);
           $nom_audio = $audio[0];
            */

          /** Insertar registro en Audios **/
          Audios_Empresa::create(
            [
                'nombre' => $request->input('nombre'),
                'descripcion'   => $request->input('descripcion'),
                'ruta' =>  'Grabaciones_'.$empresa_id."/".$request->input('ruta') ,
                'Empresas_id'   => $empresa_id
            ]
          );
      //  }

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
        return view('settings::show');
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
        Audios_Empresa::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('Audios.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'User', $mensaje, $id);

    }

}
