<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Cat_Distribuidor;

class DistribuidoresController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
<<<<<<< HEAD
        /**
         * Consultar distribuidores activos 
        */
||||||| merged common ancestors
        
=======

>>>>>>> d13b7225508f19609de2793d40ab1056f0cd8a58
        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();
        return view('administrador::distribuidores.index', compact('Distribuidores'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::distribuidores.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $file = $request->file('img_header');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public') -> put($nombre,\File::get($file));

        $file2 = $request->file('img_pie');
        $nombre2 = $file2->getClientOriginalName();
        \Storage::disk('public') -> put($nombre2,\File::get($file2));
        /**
         * Obtenemos todos los datos del formulario de alta
         */
        $input = $request->all();
        /**
         * Insertamos la informacion del formulario
         */
        $distribuidor = new Cat_Distribuidor;

        /**
         * 
         */
        $distribuidor -> servicio = $request -> servicio;
        $distribuidor -> distribuidor = $request -> distribuidor;
        $distribuidor -> numero_soporte = $request -> numero_soporte;
        $distribuidor -> img_header = $nombre;
        $distribuidor -> img_pie = $nombre2;

        $distribuidor -> save();

        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();

        return view('administrador::distribuidores.index', compact('Distribuidores'));
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
        $file = $request->file('img_header');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public') -> put($nombre,\File::get($file));

        $file2 = $request->file('img_pie');
        $nombre2 = $file2->getClientOriginalName();
        \Storage::disk('public') -> put($nombre2,\File::get($file2));


        $distribuidor = Cat_Distribuidor::find($id);

        $distribuidor -> servicio = $request -> servicio;
        $distribuidor -> distribuidor = $request -> distribuidor;
        $distribuidor -> numero_soporte = $request -> numero_soporte;
        $distribuidor -> img_header = $nombre;
        $distribuidor -> img_pie = $nombre2;

        $distribuidor -> save();

        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();

        return view('administrador::distribuidores.index', compact('Distribuidores'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Cat_Distribuidor::where( 'id', $id )->update(['activo' => 0]);

        $Distribuidores = Cat_Distribuidor::where('activo', 1)->get();

        return view('administrador::distribuidores.index', compact('Distribuidores'));
    }
}