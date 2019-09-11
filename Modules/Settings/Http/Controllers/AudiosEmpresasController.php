<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\Audios_Empresa;
use Nimbus\User;
use Storage;
use File;
use Nimbus\Http\Controllers\LogController;


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
        /** Obtenemos los datos del usuario logeado **/
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        
        /** Inserta el registro en Audios **/
        Audios_Empresa::create(
            [
                'nombre' => $request->input('nombre'),
                'descripcion'   => $request->input('descripcion'),
                'ruta' =>  $request->input('ruta') ,
                'Empresas_id'   => $empresa_id
            ]
        );      
            
       /**  Obtener datos del campo file definido en el formulario **/
       $file = $request->file('file'); 
       
       /** obtenemos el nombre del archivo **/
       $aud_nom = $file->getClientOriginalName();
    //        $ext = explode('.', $nombre_img1);
    //        $nom = "img_header_".$distribuidor->id.".".$ext[1];//creamos en nuevo nombre del archivo
   
        $dir_audios = "/audios/".$empresa_id;  
         
        if(!File::exists($dir_audios)){
           Storage::makeDirectory($dir_audios);
        }
        
         
      // Storage::disk('public')->put($directorio_imagenes."/".$nom,($file) ? File::get($file));
        Storage::disk('local')->put($dir_audios."/".$aud_nom,  \File::get($file));                  
       
        /**   Creamos el logs      */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'User',$mensaje, $user->id);
        
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
