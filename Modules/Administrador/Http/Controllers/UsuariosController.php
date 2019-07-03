<?php

namespace Modules\Administrador\Http\Controllers;

use DB;
use Nimbus\User;
use Nimbus\Clientes;
use Nimbus\Categorias;
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

        /**
         * Obtenemos los usuarios con estatus 1
         */
        $users = User::where('status', 1)->get();

        return view('administrador::usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos todos los roles
         */
        $roles = Role::all();
        /**
         * Obtenemos todos los clientes ( Empresas )
         */
        $clientes = Clientes::all();
        /**
         * Obtenemos todas la categorias
         */
        $categorias = Categorias::all();

        return view('administrador::usuarios.create', compact( 'roles', 'clientes', 'categorias' ) );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtenemos todos los datos del formulario de alta
         */
        $input = $request->all();
        /**
         * Encriptamos la contrasenia
         */
        $input['password'] = Hash::make($input['password']);
        /**
         * Insertamos la informacion del formulario
         */
        $user = User::create($input);
        /**
         * Asignamos el rol elegido
         */
        $user->assignRole( $request->input('rol') );
        /**
         * Asignamos las categorias al usuario
         */
        $data = $request->input('arr');
        for ($i=0; $i < count( $data ); $i++) {
            DB::table('categorias_user')->insert(
                ['categorias_id' => $data[$i], 'user_id' => $user->id]
            );
        }
        /**
         * Obtenemos todos los usuarios para regresar la vista
         */
        $users = User::where('status', 1)->get();

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
        /**
         * Obtenemos la informacion del usuario a editar
         */
        $user = User::findOrFail( $id );
        $catUser = $user->categorias->pluck('id')->toArray();//Categorias del usuario
        /**
         * Obtenemos todos los roles
         */
        $roles = Role::all();
        /**
         * Obtenemos todos los clientes ( Empresas )
         */
        $clientes = Clientes::all();
        /**
         * Obtenemos todas la categorias
         */
        $categorias = Categorias::where('activo', 1)->get();

        return view('administrador::usuarios.edit', compact( 'roles', 'clientes', 'user', 'categorias', 'catUser' ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Si el pass, viene vacio no lo actualizamos
         */
        if ($request->input('password') != NULL ) {
            $user = User::where( 'id', $id )
                        ->update([
                            'name' => $request->input('name'),
                            'email'   => $request->input('email'),
                            'password' => Hash::make( $request->input('password') ),
                            'id_cliente'   => $request->input('id_cliente')
                        ]);
        } else {
            $user = User::where( 'id', $id )
                        ->update([
                            'name' => $request->input('name'),
                            'email'   => $request->input('email'),
                            'id_cliente'   => $request->input('id_cliente')
                        ]);
        }

        /**
         * Se valida si el usuario ya cuenta con ese rol,
         * Si no se renueve el rol y se le asigna el nuevo
         */
        $user = User::findOrFail( $id );
        $v = $user->hasRole( Role::find( $request->input('rol') )->name );

        if ( !$v ) {
            $rol = $user->getRoleNames();//Obtengo el rol anterior
            $user->removeRole( $rol[0] );//Le quito el rol anterior
            $user->assignRole( Role::find( $request->input('rol') )->name );//Le asigno el nuevo rol
        }

        /**
         * Eliminamos las categorias que tiene el usuairo
         * y le asiganos las nuevas seleccionada
         */
        DB::table('categorias_user')->where('user_id', $user->id )->delete();
        $cats = $request->input('arr');
        for ($i=0; $i < count( $cats ); $i++) {
            DB::table('categorias_user')->insert(
                ['categorias_id' => $cats[$i], 'user_id' => $user->id]
            );
        }

         /**
         * Obtenemos todos los usuarios para regresar la vista
         */
        $users = User::where('status', 1)->get();

        return view('administrador::usuarios.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::where( 'id', $id )
        ->update([
            'status' => 0
        ]);

         /**
         * Obtenemos todos los usuarios para regresar la vista
         */
        $users = User::where('status', 1)->get();

        return view('administrador::usuarios.index', compact('users'));
    }
}
