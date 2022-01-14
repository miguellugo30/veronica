<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Cat_Distribuidor;
use Storage;
use File;
use App\Http\Controllers\LogController;
use Modules\Administrador\Http\Requests\DistribuidoresRequest;

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
        $Distribuidores = Cat_Distribuidor::active()->get();
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
    public function store(DistribuidoresRequest $request)
    {

        /**
         * Obtener los valores recibidos del formulario
         */
        $distribuidor = Cat_Distribuidor::create($request->all());
        /**
         * Imagen por defecto de c3ntro que se agregara en caso de no elegir una
         */
        $img_default = "c3ntro.jpeg";
        /**
         * Validar que el campo file_input_header tenga algun valor, para poder asignarle nombre a img_header
         * de lo contrario se utilizara el nombre de la imagen por defecto.
         */

        if($request->file('file_input_header') != NULL){

            $file = $request->file('file_input_header');//Obtenemos la informacion cargado en el input file de Imagen encabezado
            $nombre_img1 = $file->getClientOriginalName();//Obtenemos el nombre del archivo a mover
            //$distribuidor->img_header = $nombre_img1;//Asignamos el nuevo nombre al registro ha actualizar
            $ext = explode('.', $nombre_img1);
            $nom = "img_header_".$distribuidor->id.".".$ext[1];//creamos en nuevo nombre del archivo
          //  dd($nom);
        }else{

          //  dd('Np entra');
            $nom = $img_default;
            $file = $img_default;
        }
        /**
         * Validar que el campo file_input_pie tenga algun valor, para poder asignarle nombre a img_pie
         * de lo contrario se utilizara el nombre de la imagen por defecto.
         */
        if($request->file('file_input_pie') != NULL){
            $file2 = $request->file('file_input_pie');//Obtenemos la informacion cargado en el input file de Imagen pie
            $nombre_img2 = $file2->getClientOriginalName();//Obtenemos el nombre del archivo a mover
            //$distribuidor->img_pie = $nombre_img2;//Asignamos el nuevo nombre al registro ha actualizar
            $ext = explode('.', $nombre_img2);
            $nom2 = "img_footer_".$distribuidor->id.".".$ext[1];//creamos en nuevo nombre del archivo
        }else{
            $nom2 = $img_default;
            $file2 = $img_default;
        }
        /**
         * Se arma la ruta en donde se guardaran las imagenes
         */
        $directorio_imagenes = "/dist/".$distribuidor->id;

        if(!File::exists($directorio_imagenes)){
            Storage::disk('public')->makeDirectory($directorio_imagenes);
        }
  #dd($nombre_img2);

//////////////NO TENEMOS EL VALOR DEL IMG

        Storage::disk('public')->put($directorio_imagenes."/".$nom,($file) ? File::get($file) : $nombre_img1);
        Storage::disk('public')->put($directorio_imagenes."/".$nom2,($file2) ? File::get($file2) : $nombre_img2);

        /**
         * Actualizamos el nombre de las imagenes al registro actualmente creado
         */
        $distribuidor = Cat_Distribuidor::find($distribuidor->id);
        $distribuidor->img_header = $directorio_imagenes."/".$nom;//Asignamos el nuevo nombre al registro ha actualizar
        $distribuidor->img_pie = $directorio_imagenes."/".$nom2;//Asignamos el nuevo nombre al registro ha actualizar
        $distribuidor->save();

        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Cat_Distribuidor',$mensaje, $distribuidor->id);

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
    public function update(DistribuidoresRequest $request, $id)
    {
        $file = $request->file('file_input_header');
        //dd( $file );
        /**
         * Se arma la ruta en donde se guardaran las imagenes
         */
        $directorio_imagenes = "/dist/".$id;

        $distribuidor = Cat_Distribuidor::find($id);

        $distribuidor->servicio = $request->servicio;
        $distribuidor->distribuidor = $request->distribuidor;
        $distribuidor->numero_soporte = $request->numero_soporte;
        $distribuidor->prefijo = $request->prefijo;

        if( $request->file('file_input_header') != NULL){
            $file = $request->file('file_input_header');//Obtenemos la informacion cargado en el input file de Imagen encabezado
            $nombre = $file->getClientOriginalName();//Obtenemos el nombre del archivo a mover
            $ext = explode('.', $nombre);
            $nom = "img_header_".$id.".".$ext[1];//creamos en nuevo nombre del archivo
            //Storage::disk('public')->put($directorio_imagenes."/".$nombre,File::get($file));//Guardamos el archivo en el directorio correspondiente
            Storage::disk('public')->put($directorio_imagenes."/".$nom,File::get($file));//Guardamos el archivo en el directorio correspondiente
            //$distribuidor->img_header = $nombre;//Asignamos el nuevo nombre al registro ha actualizar
            $distribuidor->img_header = $directorio_imagenes."/".$nom;//Asignamos el nuevo nombre al registro ha actualizar
        }
        if(  $request->file('file_input_pie') != NULL){
            $file2 = $request->file('file_input_pie');//Obtenemos la informacion cargado en el input file de Imagen pie
            $nombre2 = $file2->getClientOriginalName();//Obtenemos el nombre del archivo a mover
            $ext = explode('.', $nombre2);
            $nom2 = "img_footer_".$id.".".$ext[1];//creamos en nuevo nombre del archivo
            //Storage::disk('public')->put($directorio_imagenes."/".$nombre2,File::get($file2));//Guardamos el archivo en el directorio correspondiente
            Storage::disk('public')->put($directorio_imagenes."/".$nom2,File::get($file2));//Guardamos el archivo en el directorio correspondiente
            //$distribuidor->img_pie = $nombre2;//Asignamos el nuevo nombre al registro ha actualizar
            $distribuidor->img_pie = $directorio_imagenes."/".$nom2;//Asignamos el nuevo nombre al registro ha actualizar
        }

        $distribuidor->save();
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Cat_Distribuidor',$mensaje, $id);

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
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Cat_Distribuidor',$mensaje, $id);

        /**
         * Se realiza la busqueda del registro para poder obtener el nombre del archivo y realizar su eliminacion del servidor
         */

        $distribuidor = Cat_Distribuidor::find($id);

        Storage:: delete([$distribuidor -> img_header],[$distribuidor -> img_pie]);

        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();
        return view('administrador::distribuidores.index', compact('Distribuidores'));
    }
}
