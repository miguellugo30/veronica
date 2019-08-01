<?php

namespace Modules\Administrador\Http\Controllers;

use Nimbus\Modulos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;

class ModulosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos los modulos que esten activos
         */
        $modulos = Modulos::where('activo', 1)
                            ->orderBy('prioridad', 'asc')
                            ->get();

        return view('administrador::modulos.index', compact('modulos') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administrador::modulos.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Insertamos la informacion del formulario
         */
        $cat = Modulos::create($request->all());
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Modulos',$mensaje, $cat->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('modulos.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administrador::modulos.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
         /**
         * Obtenemos la informacion del menu a editar
         */
        $modulo = Modulos::findOrFail( $id );
        return view('administrador::modulos.edit', compact( 'modulo', 'id' ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Modulos::where( 'id', $id )
        ->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion')
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Modulos',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('modulos.index');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Modulos::where( 'id', $id )
                ->update(['activo' => 0]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Modulos', $mensaje, $id);
       /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('modulos.index');
    }

    public function ordering()
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $modulos = Modulos::where('activo', 1)->orderBy('prioridad', 'ASC')->get();

        return view('administrador::modulos.ordering', compact('modulos') );
    }

    public function updateOrdering(Request $request)
    {

        $elementos = explode(',', $request->input('ordenElementos') );
        $prioridad = 1;

        for ($i=0; $i < count( $elementos ); $i++) {

            $id = explode('_',$elementos[$i] );

            Modulos::where( 'id', $id[1] )
                        ->update([
                            'prioridad' => $prioridad
                        ]);
            $prioridad++;
        }
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('modulos.index');

    }
}
