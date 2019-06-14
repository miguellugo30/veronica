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
use Nimbus\Clientes;

class DidController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     
    
    public function index()
    {
        $Dids = Dids::where('activo',1)->get();
        //dd($Dids);
        
        // Esta es la ruta en donde esta vista y donde se va a enviar la respuesta del controlador
       return view('administrador::dids.index', compact('Dids'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos todos los clientes ( Empresas )
         * Crear tabla Empresas!
        */
        $empresas = Clientes::all();
        
        return view('administrador::dids.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        
        $input = $request->all();
        /**
         * Insertamos la informacion del formulario
         */
       
        Dids::create($input);

        $Dids = Dids::where('activo', 1)->get();

        return view('administrador::dids.index', compact('Dids'));
        
        
        
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
        $Dids = Dids::find($id);
        
        //dd($Dids);
        return view('administrador::dids.edit',compact('Dids'));
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
        $Dids -> id_empresa = $request -> id_empresa;
        $Dids -> tipo = $request -> tipo;
        $Dids -> prefijo = $request -> prefijo;
        $Dids -> did = $request -> did;
        $Dids -> descripcion = $request -> descripcion;
        $Dids -> id_troncal_sansay = $request -> id_troncal_sansay;
        $Dids -> gateway = $request -> gateway;
        $Dids -> fakedid = $request -> fakedid;        
       
        //Aplicar la funcion save y guardar los valor obtenidos
        $Dids -> save();
         
        $Dids = Dids::where('activo', 1)->get();
        return view('administrador::dids.index', compact('Dids'));
                
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Dids::where( 'id', $id )->update(['activo' => 0]);

        $Dids = Dids::where('activo', 1)->get();
        return view('administrador::dids.index', compact('Dids'));
    }
}
