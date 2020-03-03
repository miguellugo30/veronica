<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\PrefijosMarcacion;
use Nimbus\User;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Http\Requests\PrefijosMarcacionRequest;
use Nimbus\Http\Controllers\LogController;

class PrefijosMarcacionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Obtenemos los prefijos de la empresa
         */
        $prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$empresa_id)->get();
        return view('settings::PrefijosMarcacion.index', compact('prefijos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('settings::PrefijosMarcacion.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PrefijosMarcacionRequest $request)
    {
        /**
         * Insertamos la información del Agente
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        PrefijosMarcacion::active()->where('fk_empresas_id',$empresa_id)->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'prefijo' => $request->prefijo,
            'prefijo_nuevo' => $request->prefijoNuevo,
            'fk_empresas_id' => $empresa_id,
            'activo' => 1
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Prefijos_marcacion',$mensaje, $empresa_id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('PrefijosMarcacion.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos el id empresa del usuario para obtener los prefijos
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $Prefijos = PrefijosMarcacion::active()->where('id',$id)->first();

        return view('settings::PrefijosMarcacion.edit', compact('Prefijos'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PrefijosMarcacionRequest $request, $id)
    {
        /**
         * Obtenemos el id empresa del usuario para actualizar los prefijos
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        PrefijosMarcacion::active()->where('id',$id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'prefijo' => $request->prefijo,
            'prefijo_nuevo' => $request->prefijoNuevo,
            'fk_empresas_id' => $empresa_id,
            'activo' => 1
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Prefijos_marcacion',$mensaje, $id);

        return redirect()->route('PrefijosMarcacion.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        PrefijosMarcacion::where('id',$id)->update([
            'activo'=> 0
        ]);

         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Prefijos_marcacion', $mensaje, $id);

        return redirect()->route('PrefijosMarcacion.index');
    }
}
