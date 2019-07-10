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

        return view('administrador::dids.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtener los dids que se van a insertar separados por ;
         */
        $dids = $request->dids;
        $dids_store = str_replace("\n",";",$dids);
        
        
        /**
         * Crear un array de los elementos donde se separan por ;
         */
        $dids = explode(";",$dids_store);        
        /**
         * Se recorre arreglo de dids
         */
        foreach ($dids as $did => $value) {
            Dids::create(['prefijo'=>$request->prefijo,
                    'numero_real'=>$request->numero_real,
                    'did'=>trim($value),
                    'referencia'=>$request->referencia,
                    'gateway'=>$request->gateway,
                    'fakedid'=>$request->fakedid,
                    'Canales_id'=> $request->Canales_id,
                    'Empresas_id'=>$request->Empresas_id]);
        }       
        
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
        $empresa = Empresas::findOrFail($id);
        $canales = $empresa->Canales;
        
        return view('administrador::dids.show',compact('canales'));
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
         * Obtenemos los canales que estan vinculadas a la empresa vinculada al DID
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
        $Dids = Dids::findOrFail($id);
        //Asignar los datos del Request del form a las variables asociadas
        $Dids->Empresas_id = $request->Empresas_id;
        $Dids->prefijo = $request->prefijo;
        $Dids->did = $request->did;
        $Dids->numero_real = $request->numero_real;
        $Dids->referencia = $request->referencia;
        $Dids->Canales_id = $request->Canales_id;
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
