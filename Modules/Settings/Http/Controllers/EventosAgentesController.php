<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;
use Modules\Settings\Http\Requests\EventosRequest;

use App\User;
use App\Eventos_Agentes;
use App\Agentes;

class EventosAgentesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Sacamos los datos del Usuario y su empresa para obtener los eventos
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $eventos = Eventos_Agentes::empresa($empresa_id)->active()->get();
        return view('settings::EventosAgentes.index',compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('settings::EventosAgentes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(EventosRequest $request)
    {
        //
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $datos = $request->all();
        $datos['Empresas_id'] = $empresa_id;
        if ($datos['tiempo'] == 60) {
            $datos['tiempo'] = '01:00:00';
        } else {
            $datos['tiempo'] = '00:'.$datos['tiempo'].':00';
        }
        Eventos_Agentes::create($datos);

        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, información capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'EventosAgentes',$mensaje, $user->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('EventosAgentes.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::EventosAgentes.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $eventos = Eventos_Agentes::where('id',$id)->first();
        return view('settings::EventosAgentes.edit', compact('eventos'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(EventosRequest $request, $id)
    {
        //
        Eventos_Agentes::where( 'id', $id )
            ->update([
                    'nombre' => $request->input('nombre'),
                    'tiempo' => $request->input('tiempo')
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', información editada: '.var_export($request->all(), true);
            $log = new LogController;
            $log->store('Actualización', 'EventosAgentes',$mensaje, $id);
            return redirect()->route('EventosAgentes.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Eventos_Agentes::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('EventosAgentes.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'EventosAgentes', $mensaje, $id);
    }
}
