<?php

namespace Modules\Monitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Categorias;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        /**
         * Obtenemos el rol del usuario logeado
         */
        $rol = $user->getRoleNames();
        /**
         * Obtenemos las categorias relacionadas al usuario
         */
        $categorias = Categorias::where('modulos_id', 3)->get();
        $modulo = "Monitor";

        return view('monitor::index', compact( 'rol', 'categorias', 'modulo' ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('monitor::create');
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
        return view('monitor::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('monitor::edit');
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
