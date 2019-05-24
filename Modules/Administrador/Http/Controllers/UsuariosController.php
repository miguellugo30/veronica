<?php

namespace Modules\Administrador\Http\Controllers;

use Nimbus\User;
use Nimbus\Clientes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('administrador::usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        $clientes = Clientes::all();
        return view('administrador::usuarios.create', compact( 'roles', 'clientes' ) );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
       
        $user = User::create($input);
        $user->assignRole( $request->input('rol') );

        $users = User::all();

        return view('administrador::usuarios.index', compact('users'));
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
