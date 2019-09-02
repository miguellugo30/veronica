<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Agentes;
use Nimbus\Buzon_Voz;
use Nimbus\Audios_Empresa;


class BuzonVozController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $buzones = Buzon_Voz::active()->where('Empresas_id',$empresa_id)->get();

        return view('inbound::Buzon_Voz.index',compact('buzones'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $audios = Audios_Empresa::active()->where('Empresas_id',$empresa_id)->get();
        //dd($audios);


        return view('inbound::Buzon_Voz.create',compact('empresa_id','audios'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
        * Insertar información del Buzon de voz
        */
        //dd($request);
        Buzon_Voz::create(
            [
                'nombre' => $request->input('nombre'),
                'tiempo_maximo'   => $request->input('tiempo_maximo'),
                'terminacion' => $request->input('terminacion'),
                'correos' => $request->input('correos'),
                'Audios_Empresa_id' => $request->input('Audios_Empresa_id'),
                'Empresas_id' => $request->input('Empresas_id')
            ]
        );
        return redirect()->route('Buzon_Voz.index');
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
        $audios = Audios_Empresa::active()->where('Empresas_id',$empresa_id)->get();

        $buzon = Buzon_Voz::where('id',$id)->first();

        return view('inbound::Buzon_Voz.edit',compact('buzon','empresa_id','audios'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Buzon_Voz::where( 'id', $id )
            ->update([
                'nombre' => $request->input('nombre'),
                'tiempo_maximo'   => $request->input('tiempo_maximo'),
                'terminacion' => $request->input('terminacion'),
                'correos' => $request->input('correos'),
                'Audios_Empresa_id' => $request->input('Audios_Empresa_id'),
                'Empresas_id' => $request->input('Empresas_id')
                ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request, true);
            $log = new LogController;
            $log->store('Actualizacion', 'Buzon_Voz',$mensaje, $id);
            return redirect()->route('Buzon_Voz.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Buzon_Voz::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('Buzon_Voz.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Buzon_Voz', $mensaje, $id);
    }
}
