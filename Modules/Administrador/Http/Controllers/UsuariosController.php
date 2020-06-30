<?php

namespace Modules\Administrador\Http\Controllers;

use App\User;
use App\Empresas;
use App\Categorias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\LogController;
use Modules\Administrador\Http\Requests\UsuariosRequest;

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
        $clientes = Empresas::active()->get();
        /**
         * Obtenemos todas la categorias
         */
        $categorias = Categorias::active()->get();

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
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'User',$mensaje, $user->id);
        /**
         * Asignamos el rol elegido
         */
        $user->assignRole( $request->input('rol') );
        /**
         * Asignamos las categorias al usuario
         */
        $user->syncPermissions( $request->input('arr'));
        /**
         * Limpiamos la cache
         */
        Artisan::call('cache:clear');
       /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('usuarios.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Ocupamos esta función para mostrar los módulos contratados por la empresa
         * para que puedan ser seleccionados al dar de alta un usuario nuevo
         */
        $empresa = Empresas::find( $id );
        $modulos = $empresa->Modulos;
        return view('administrador::usuarios.show', compact('modulos'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la información del usuario a editar
         */
        $user = User::findOrFail( $id );
        /**
         * Obtenemos todos los roles
         */
        $roles = Role::all();
        /**
         * Obtenemos todos los clientes ( Empresas )
         */
        $clientes =  Empresas::active()->get();

        /**
         * Obtenemos los modulos activos para la empresa
         */
        $empresa = Empresas::find( $user->id_cliente );
        $modulos = $empresa->Modulos;
        /**
         * Limpiamos la cache
         */
        Artisan::call('cache:clear');

        return view('administrador::usuarios.edit', compact( 'roles', 'clientes', 'user', 'modulos' ));
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
         * Eliminamos las categorias que tiene el usuario
         * y le asignamos las nuevas seleccionada
         */
        $user->syncPermissions( $request->input('arr'));
        /*
        DB::table('categorias_user')->where('user_id', $user->id )->delete();
        $cats = $request->input('arr');
        for ($i=0; $i < count( $cats ); $i++) {
            DB::table('categorias_user')->insert(
                ['categorias_id' => $cats[$i], 'user_id' => $user->id]
            );
        }
        */
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'User',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('usuarios.index');
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
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'User', $mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('usuarios.index');
    }
}
