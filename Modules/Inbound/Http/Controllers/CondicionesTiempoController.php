<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Condiciones_Tiempo;


class CondicionesTiempoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
        * Sacamos los datos del agente y su empresa para obtener los agentes
        */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $condicionestiempo = Condiciones_Tiempo::active()->where('Empresas_id',$empresa_id)->get();

        return view('inbound::Condiciones_Tiempo.index',compact('condicionestiempo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dias=[
            ['value'=>'mon', 'texto'=>'Lunes'],
            ['value'=>'tue', 'texto'=>'Martes'],
            ['value'=>'wed', 'texto'=>'Miercoles'],
            ['value'=>'thu', 'texto'=>'Jueves'],
            ['value'=>'fri', 'texto'=>'Viernes'],
            ['value'=>'sat', 'texto'=>'Sabado'],
            ['value'=>'sun', 'texto'=>'Domingo'],
        ];
        $meses=[
            ['value'=>'jan', 'texto'=>'Enero'],
            ['value'=>'feb', 'texto'=>'Febrero'],
            ['value'=>'mar', 'texto'=>'Marzo'],
            ['value'=>'apr', 'texto'=>'Abril'],
            ['value'=>'may', 'texto'=>'Mayo'],
            ['value'=>'jun', 'texto'=>'Junio'],
            ['value'=>'jul', 'texto'=>'Julio'],
            ['value'=>'aug', 'texto'=>'Agosto'],
            ['value'=>'sep', 'texto'=>'Septiembre'],
            ['value'=>'oct', 'texto'=>'Octubre'],
            ['value'=>'nov', 'texto'=>'Noviembre'],
            ['value'=>'dec', 'texto'=>'Diciembre'],
        ];
        //dd($dia);
        return view('inbound::Condiciones_Tiempo.create',compact('dias','meses'));
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
        //
    }
}
