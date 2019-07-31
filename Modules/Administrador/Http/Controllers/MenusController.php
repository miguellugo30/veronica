<?php

namespace Modules\Administrador\Http\Controllers;

use Nimbus\Categorias;
use Nimbus\Sub_Categorias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $log = new Logger('Nimbus');
        $log->pushHandler(new StreamHandler('log/prueba.log', Logger::WARNING));

        // add records to the log
        $log->debug('Foo');
        $log->info('INFORMATIVO');
        $log->notice('Foo');
        $log->warning('Foo');
        $log->error('INFORMATIVO');
        $log->critical('INFORMATIVO');
        $log->alert('INFORMATIVO');
        $log->emergency('INFORMATIVO');
        /**
         * Obtenemos los menus con estatus 1
         */
        $categorias = Categorias::active()->get();

        return view('administrador::menus.index', compact('categorias') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
         /**
         * Obtenemos los menus con estatus 1
         */
        $categorias = Categorias::active()->get();

        return view('administrador::menus.create', compact('categorias'));
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
        Categorias::create($request->all());
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $subCategorias = Sub_Categorias::where('id_categoria', $id)
                                        ->where('activo', 1)
                                        ->orderBy('prioridad', 'asc')
                                        ->get();


        return view('administrador::menus.show', compact('subCategorias','id'));
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
        $categoria = Categorias::findOrFail( $id );

        return view('administrador::menus.edit', compact( 'categoria' ));
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
         * Actualizamos el menu
         */
         Categorias::where( 'id', $id )
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'descripcion' => $request->input('descripcion'),
                        'tipo' => $request->input('tipo'),
                    ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Categorias::where( 'id', $id )
        ->update([
            'activo' => 0
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');

    }

    public function ordering()
    {
        /**
         * Obtenemos los menus con estatus 1
         */
        $categorias = Categorias::where('activo', 1)->orderByRaw('prioridad ASC')->get();

        return view('administrador::menus.ordering', compact('categorias') );

    }

    public function updateOrdering(Request $request)
    {

        $elementos = explode(',', $request->input('ordenElementos') );
        $prioridad = 1;

        for ($i=0; $i < count( $elementos ); $i++) {

            $id = explode('_',$elementos[$i] );

            Categorias::where( 'id', $id[1] )
                        ->update([
                            'prioridad' => $prioridad
                        ]);
            $prioridad++;
        }

        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('menus.index');

    }
}
