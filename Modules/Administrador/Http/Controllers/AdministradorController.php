<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Nimbus\User;
use Illuminate\Support\Facades\Auth;

class AdministradorController extends Controller
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
        $categorias = $user->categorias;

        return view('administrador::index', compact( 'rol', 'categorias' ) );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $rol        = Session::get('rol');
        $categorias = Session::get('categorias');

        return view('administrador::create', compact( 'rol', 'categorias' ));
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
        return view('administrador::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('administrador::edit');
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
