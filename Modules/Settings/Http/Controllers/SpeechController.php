<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Speech;
use Nimbus\Opciones_Speech;
use DB;
use Modules\Settings\Http\Requests\SpeechRequest;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        $speech = Speech::empresa($empresa_id)->active()->get();

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
    public function store(SpeechRequest $request)
    {
        $dataForm = $request->input('dataForm');
        $data = $request->dataForm;

        /**
         * Insertamos la información del Agente
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información a la tabla de Speech
         */
         $speech = Speech::create([
             'tipo'=>$data['tipo'],
             'nombre'=>$data['nombre'],
             'descripcion'=>$data['descripcion'],
             'activo'=>1,
             'Empresas_id'=>$empresa_id
             ]);
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 2 );
        /**
         * Insertamos la información de las Opciones Speech
         */
         $j = 1;
         for ($i=0; $i < count( $info ); $i++) {

                Opciones_Speech::create([
                                            'nombre' => $info[$i][0],
                                            'texto' => $info[$i][1],
                                            'prioridad' => $j,
                                            'speech_id' => $speech->id
                                        ]);
                $j = $j + 1;
            }
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
        $campos = $speech->Opciones_Speech;
        return view('settings::Speech.show', compact('speech', 'campos'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //$speech = Speech::active()->get();
        $speech = Speech::find($id);
        return view('settings::Speech.edit', compact('speech'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SpeechRequest $request, $id)
    {
        $dataForm = $request->input('dataForm');
        $data = $request->dataForm;
        $idSpeech = $data['id'];
        Opciones_Speech::where('speech_id', $idSpeech)->delete();

        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 2 );
        /**
         * Insertamos la información de las Opciones Speech
         */
        $j = 1;
        for ($i=0; $i < count( $info ); $i++) {
            if ($idSpeech != NULL) {
                $opciones = Opciones_Speech::create([
                    'nombre' => $info[$i][0],
                    'texto' => $info[$i][1],
                    'prioridad' => $j,
                    'speech_id' => $idSpeech
                ]);
                $j = $j + 1;

            } else {
                Opciones_Speech::where('speech_id',$idSpeech)->update([
                    'nombre' => $info[$i][0],
                    'texto' => $info[$i][1],
                    'prioridad' => $j,
                ]);
                $j = $j + 1;
            }
        }
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
