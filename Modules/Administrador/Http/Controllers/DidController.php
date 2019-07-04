<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
/*
* Agregar el modelo de la tabla que debe usar nuestro modulo
*/
use Nimbus\Dids;
// Agregar modelo Clientes para acceder a los datos
use Nimbus\Empresas;
use Nimbus\Canales;
use Nimbus\Config_Empresas;

class DidController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */


    public function index()
    {
        /**
         * Recuperamos todos los did que esten activos
         */
        $Dids = Dids::where('activo',1)->get();
        return view('administrador::dids.index', compact('Dids'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos todos las Empresas
         * Crear tabla Empresas!
        */
        $empresas = Empresas::where('activo',1)->get();
        $canales = Canales::where('activo',1)->get();
        $distribuidor = Config_Empresas::where('Cat_Distribuidor_id',11)->where($empresas->id)->get();

        return view('administrador::dids.create', compact('empresas', 'canales','distribuidor'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Insertamos la información del formulario
         */
        Dids::create( $request->all() );
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('did.index');
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
         * Obtenemos la información del DID ha editar
         */
        $Dids = Dids::find($id);
        /**
         * Obtenemos las empresas activas
         */
        $empresas = Empresas::where('activo',1)->get();
        /**
         * Obtenemos las troncales que estan vinculadas a la empresa vinculada al DID
         */
        $empresa = Empresas::findOrFail(  $Dids->Empresas->id );
        $canales = $empresa->canales;
        return view('administrador::dids.edit',compact('Dids', 'empresas', 'canales'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //Obtener los datos del id_did que se envia
        $Dids = Dids::find($id);

        //Asignar los datos del Request del form a las variables asociadas
        $Dids->Empresas_id = $request->Empresas_id;
        $Dids->tipo = $request->tipo;
        $Dids->prefijo = $request->prefijo;
        $Dids->did = $request->did;
        $Dids->descripcion = $request->descripcion;
        $Dids->Canales_id = $request->id_canal;
        $Dids->gateway = $request->gateway;
        $Dids->fakedid = $request->fakedid;

        //Aplicar la funcion save y guardar los valor obtenidos
        $Dids -> save();
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('did.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Dids::where( 'id', $id )->update(['activo' => 0]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('did.index');
    }
}
