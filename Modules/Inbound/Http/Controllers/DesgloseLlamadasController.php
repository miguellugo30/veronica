<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;

use Nimbus\User;
use Nimbus\Crd_Call_Center;
use Modules\Inbound\Http\Controllers\QueryreportdesgloseController;

use Nimbus\Cdr_call_center;

class DesgloseLlamadasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        //dd ($empresa_id);
        return view('inbound::DesgloseLlamadas.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::DesgloseLlamadas.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $desglose = QueryreportdesgloseController::query( $request->dateinicio, $request->datefin, $empresa_id );
        //Cdr_call_center::empresa(24)->whereBetween('fecha_inicio', [$fechaI, $fechaF])->get();
        
        //dd($desglose);

        return view('inbound::DesgloseLlamadas.show',compact('desglose'));


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
        //
    }
}
