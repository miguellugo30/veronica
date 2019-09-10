<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Speech;
use DB;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $speech = Speech::active()->get();
        return view('settings::Speech.index',compact('speech'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtener los tipos de speech para el tipo de
         */
        $speech = Speech::all();
        return view('settings::Speech.create',compact('speech'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        /**
         * Insertamos la información del Agente
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertamos el nuevo agentes
         */
        $datos = $request->all();
        $datos['Empresas_id'] = $empresa_id;
        Speech::create($datos);
        return redirect()->route('speech.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $speech = Speech::find( $id );
        //$campos = $speech->Opciones_Speech;
        return view('settings::Speech.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $tipospeech = Speech::findOrFail($id);
        $speech = Speech::where('id',$id)->first();
        return view('settings::Speech.edit',compact('speech','tipospeech'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Speech::where( 'id', $id )
            ->update([
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion'),
                    'tipo' => $request->input('tipo')
                ]);

            return redirect()->route('speech.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Speech::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('speech.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Speech', $mensaje, $id);
    }
}
