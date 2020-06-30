<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Cat_Estado_Cliente;
use App\Http\Controllers\LogController;
use Modules\Administrador\Http\Requests\EstadoClienteRequest;

class CatEstadoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
        * Recuperamos todos los catalogos que esten activos
        */
       $cat_clientes =  Cat_Estado_Cliente::where('activo',1)->get();
        return view('administrador::cat_cliente.index', compact('cat_clientes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::cat_cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(EstadoClienteRequest $request)
    {
         /**
         * Obtenemos todos los datos del formulario de alta y
         * los insertamos la informacion del formulario
         */
        $cat = Cat_Estado_Cliente::create(  $request->all() );
         /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Cat_Estado_Cliente',$mensaje, $cat->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_cliente.index');
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
         * Obtenemos la informacion del catalogo a editar
         */
        $cat_cliente = Cat_Estado_Cliente::findOrFail( $id );
        return view('administrador::cat_cliente.edit', compact( 'cat_cliente', 'id' ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(EstadoClienteRequest $request, $id)
    {
        /**
         * Actualizamos los campos
         */
        Cat_Estado_Cliente::where( 'id', $id )
        ->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'marcar' => $request->input('marcar'),
            'mostrar_agente' => $request->input('mostrar_agente'),
            'parametrizar' => $request->input('parametrizar'),
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Cat_Estado_Cliente',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos los campos
         */
        Cat_Estado_Cliente::where( 'id', $id )
        ->update([
            'activo' => '0'
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Cat_Estado_Cliente',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_cliente.index');
    }

    public function ordering()
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $cat_clientes = Cat_Estado_Cliente::where('activo', 1)->orderByRaw('orden ASC')->get();
        return view('administrador::cat_cliente.ordering', compact('cat_clientes') );

    }

    public function updateOrdering(Request $request)
    {

        $elementos = explode(',', $request->input('ordenElementos') );
        $prioridad = 1;

        for ($i=0; $i < count( $elementos ); $i++) {

            $id = explode('_',$elementos[$i] );

            Cat_Estado_Cliente::where( 'id', $id[1] )
                        ->update([
                            'orden' => $prioridad
                        ]);
            $prioridad++;
        }
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_cliente.index');
    }
}
