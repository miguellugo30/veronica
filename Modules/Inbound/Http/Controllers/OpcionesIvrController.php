<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Ivr_Opciones;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Http\Controllers\LogController;

class OpcionesIvrController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('inbound::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('inbound::edit');
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
        Ivr_Opciones::where('id',$id)->update(['activo'=>'0']);
        /**
         * Creamos el logs
         */
        $user = User::find( Auth::id() );
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'Opciones_Ivr',$mensaje, $user->id);

    }
}
