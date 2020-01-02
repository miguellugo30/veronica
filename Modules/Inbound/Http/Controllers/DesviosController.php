<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Modules\Inbound\Http\Requests\DesviosRequest;

use Nimbus\User;
use Nimbus\Desvios;
use Nimbus\Canales;



class DesviosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $desvios = Desvios::empresa($empresa_id)->active()->with('Canales')->get();
        return view('inbound::Desvios.index',compact('desvios'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $canales = Canales::active()->where('Empresas_id',$empresa_id)->get();
        //dd($canales);
        return view('inbound::Desvios.create',compact('canales','empresa_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DesviosRequest $request)
    {
        /**
        * Insertar información del desvio
        */
        Desvios::create(
            [
                'nombre' => $request->input('nombre'),
                'Canales_id'   => $request->input('Canales_id'),
                'dial' => $request->input('dial'),
                'ringeo' => $request->input('ringeo'),
                'Empresas_id' => $request->input('Empresas_id')
            ]
        );
        return redirect()->route('Desvios.index');
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'User',$mensaje, $user->id);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $desvios = Desvios::where('id',$id)->first();
        $canales = Canales::active()->where('Empresas_id',$empresa_id)->get();

        return view('inbound::Desvios.edit',compact('desvios','canales','empresa_id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DesviosRequest $request, $id)
    {
        Desvios::where( 'id', $id )
            ->update([
                'nombre' => $request->input('nombre'),
                'Canales_id'   => $request->input('Canales_id'),
                'dial' => $request->input('dial'),
                'ringeo' => $request->input('ringeo'),
                'Empresas_id' => $request->input('Empresas_id')
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
            $log = new LogController;
            $log->store('Actualizacion', 'Desvios',$mensaje, $id);
            return redirect()->route('Desvios.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Desvios::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('Desvios.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Desvios', $mensaje, $id);
    }
}
