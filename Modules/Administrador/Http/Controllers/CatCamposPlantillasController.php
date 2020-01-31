<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_Campos_Plantillas;
use Nimbus\Empresas;
use Illuminate\Support\Facades\Auth;
use Nimbus\Http\Controllers\LogController;
use Modules\Administrador\Http\Requests\CamposPlantillasRequest;

class CatCamposPlantillasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cat_campos_plantillas = Cat_Campos_Plantillas::with('Empresas')->get();
        //dd($cat_campos_plantillas);
        return view('administrador::cat_campos_plantillas.index', compact('cat_campos_plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::cat_campos_plantillas.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CamposPlantillasRequest $request)
    {
        /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la informacion del formulario
         */
        $cat = Cat_Campos_Plantillas::create(  $request->all() );
        /**
         * Obtenemos id de la empresa
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Buscamos la empresa
         */
        $empresa = Empresas::findOrFail($empresa_id);
        /**
         * Vinculamos los campos con la empresa
         */
        $empresa->Cat_campos_plantillas()->attach($cat);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Cat_campos_plantillas',$mensaje, $cat->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_campos_plantillas.index');
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
        /**
         * Obtenemos la informacion del catalogo a editar
         */
        $cat_campos_plantillas = Cat_Campos_Plantillas::findOrFail( $id );
        return view('administrador::cat_campos_plantillas.edit', compact('cat_campos_plantillas', 'id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CamposPlantillasRequest $request, $id)
    {
        /**
         * Actualizamos los campos
         */
        Cat_Campos_Plantillas::where( 'id', $id )
        ->update([
            'nombre' => $request->input('nombre')
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Cat_campos_plantillas',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_campos_plantillas.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Obtenemos id de la empresa
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Buscamos la empresa
         */
        $empresa = Empresas::findOrFail($empresa_id);
        /**
         * Desvinculamos todos los campos a la empresa
         */
        $empresa->Cat_campos_plantillas()->detach($id);
        //dd($empresa);
        /**
         * Actualizamos los campos
         */
        Cat_Campos_Plantillas::where( 'id', $id )
        ->delete();
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Cat_campos_plantillas',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_campos_plantillas.index');
    }
}
