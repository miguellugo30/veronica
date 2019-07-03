<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_Distribuidor;
use Storage;
use File;

class DistribuidoresController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Consultar distribuidores activos para mostrarlos en el indice
        */
        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();
        return view('administrador::distribuidores.index', compact('Distribuidores'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Retorna la vista de creacion para distribuidores
         */
        return view('administrador::distribuidores.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtener los valores recibidos del formulario
         */
        $distribuidor = new Cat_Distribuidor;
        $distribuidor -> servicio = $request -> servicio;
        $distribuidor -> distribuidor = $request -> distribuidor;
        $distribuidor -> numero_soporte = $request -> numero_soporte;
        $distribuidor -> prefijo = $request -> prefijo;

        /**
         * Imagen por defecto de c3ntro que se agregara en caso de no elegir una
         */
        $img_default = "c3ntro.jpeg";

        /**
         * Validar que el campo file_input_header tenga algun valor, para poder asignarle nombre a la imagen header
         */        
        if( $request->file('file_input_header') != NULL){
            $file = $request->file('file_input_header');
            $nombre = $file->getClientOriginalName();
            $distribuidor -> img_header = $nombre;

        }else{
            $nombre = $img_default;
        }

        if(  $request->file('file_input_pie') != NULL){
            $file2 = $request->file('file_input_pie');
            $nombre2 = $file2->getClientOriginalName();
            $distribuidor -> img_pie = $nombre2;
        }else{
            $nombre2 = $img_default;
        }
       
        $distribuidor -> save();  
        
        
        $directorio_imagenes = "/dist/".$distribuidor -> id;
        /*
        if(!File::exists($directorio_imagenes)){
            Storage::makeDirectory($directorio_imagenes);
        }*/
        Storage::disk('public') -> put($directorio_imagenes."/".$nombre,($file) ? File::get($file) : $nombre);
        Storage::disk('public') -> put($directorio_imagenes."/".$nombre2,($file2) ? File::get($file2) : $nombre2);
        return redirect()->route('distribuidor.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administrador::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $distribuidor = Cat_Distribuidor::find($id);
        return view('administrador::distribuidores.edit',compact('distribuidor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $distribuidor = Cat_Distribuidor::find($id);

        $distribuidor -> servicio = $request -> servicio;
        $distribuidor -> distribuidor = $request -> distribuidor;
        $distribuidor -> numero_soporte = $request -> numero_soporte;
        $distribuidor -> prefijo = $request -> prefijo;
       
        if( $request->file('file_input_header') != NULL){
            $file = $request->file('file_input_header');
            $nombre = $file->getClientOriginalName();
            Storage::disk('public') -> put($nombre,File::get($file));
            $distribuidor -> img_header = $nombre;

        } 
        if(  $request->file('file_input_pie') != NULL){
            $file2 = $request->file('file_input_pie');
            $nombre2 = $file2->getClientOriginalName();
            Storage::disk('public') -> put($nombre2,File::get($file2));
            $distribuidor -> img_pie = $nombre2;
        } 
        
        $distribuidor -> save();        
        return redirect()->route('distribuidor.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Se realiza la actualizacion con referencia al id que se recibio
         */
        Cat_Distribuidor::where( 'id', $id )->update(['activo' => 0]);

        /**
         * Se realiza la busqueda del registro para poder obtener el nombre del archivo y realizar su eliminacion del servidor
         */

        $distribuidor = Cat_Distribuidor::find($id);

        Storage:: delete([$distribuidor -> img_header],[$distribuidor -> img_pie]);

        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();
        return view('administrador::distribuidores.index', compact('Distribuidores'));
    }
}