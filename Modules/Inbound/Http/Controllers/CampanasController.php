<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Campanas;

class CampanasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $campanas= Campanas::active()->get();

        return view('inbound::campanas.index',compact('campanas'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('inbound::campanas.create');
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
        //dd($id);
        Campanas::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('campanas.index');
    }
}
