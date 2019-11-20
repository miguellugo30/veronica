<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use Nimbus\Cdr_call_center;

class ACDController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('inbound::ACD.index');
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

        $fechaI = Carbon::parse( $request->dateInicio );
        $fechaF = Carbon::parse( $request->dateFin );

        $diff = $fechaI->diffForHumans( $fechaF );

        return $diff;
        /*
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $data = Cdr_call_center::empresa( $empresa_id )
                                ->tipollamada('Inbound')
                                ->whereBetween('fecha_inicio', [$request->dateInicio, $request->dateFin])
                                ->get();

        //dd( $data );
        return view('inbound::ACD.show');
        */
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
