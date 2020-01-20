<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Http\Requests\SpeechRequest;
use DB;
use Nimbus\Http\Controllers\LogController;

use Nimbus\User;
use Nimbus\Speech;
use Nimbus\Opciones_Speech;

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
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Obtener los Speech
         */
        $speechs = Speech::empresa($empresa_id)->active()->get();
        return view('settings::Speech.create',compact('speechs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SpeechRequest $request)
    {
        $data = $request->dataForm;
        /**
         * Obtenemos la información del Usuario
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información a la tabla de Speech
         *
         * Dependiendo del tipo de speech es la forma en que se guardara la información
         */
        if ( $data['tipo'] == 'estatico' )
        {
            Speech::create([
                'tipo'=>$data['tipo'],
                'nombre'=>$data['nombre'],
                'descripcion'=>$data['descripcion'],
                'texto'=>$data['descripcionSpeech'],
                'Empresas_id'=>$empresa_id
                ]);
        }
        else
        {
            $speech = Speech::create([
                                        'tipo'=>$data['tipo'],
                                        'nombre'=>$data['nombre'],
                                        'descripcion'=>$data['descripcion'],
                                        'texto'=>"",
                                        'activo'=>1,
                                        'Empresas_id'=>$empresa_id
                                    ]);
            /**
             * Insertamos el Speech de Bienvenida
             */
            Opciones_Speech::create([
                                        'tipo' => 1,
                                        'nombre' => $data['nombre'],
                                        'speech_id_hijo' => $data['speech-inicial'],
                                        'speech_id' => $speech->id
                                    ]);
            array_shift( $data );
            array_shift( $data );
            array_shift( $data );
            array_shift( $data );

            $info = array_chunk( $data, 2 );
            /**
             * Insertamos la información de las Opciones Speech
             **/
            for ($i=0; $i < count( $info ); $i++)
            {
                Opciones_Speech::create([
                                            'tipo' => 0,
                                            'nombre' => $info[$i][0],
                                            'speech_id_hijo' => $info[$i][1],
                                            'speech_id' => $speech->id
                                        ]);
            }
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
        $bienvenida = '';

        $speech = Speech::find( $id );
        $campos = $speech->Opciones_Speech;

        if ( $speech->tipo == 'dinamico' )
        {

            $bienvenida = $this->textoBienvenida( $campos->where('tipo', 1)->first()->id );
        }

        return view('settings::Speech.show', compact('speech', 'campos', 'bienvenida'));
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $bienvenida = '';

        $speech = Speech::find($id);
        $campos = $speech->Opciones_Speech;

        if ( $speech->tipo == 'dinamico' )
        {
            $bienvenida = $this->textoBienvenida( $campos->where('tipo', 1)->first()->id );
        }
        /**
         * Obtener los Speech
         */
        $speechs = Speech::empresa($speech->Empresas_id)->active()->get();
        return view('settings::Speech.edit', compact('speech', 'campos', 'bienvenida', 'speechs'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SpeechRequest $request, $id)
    {
        /**
         * Obtenemos el nombre del speech principal
         */
        $nombreSpeech = Speech::select('nombre', 'tipo')->where('id', $id)->first();

        $data = $request->dataForm;

        if ( $nombreSpeech->tipo == 'dinamico' )
        {
            /**
             * Eliminamos las opciones originales del speech, para insertar las nuevas
             **/
            Opciones_Speech::where('speech_id', $id)->delete();
            /**
             * Insertamos el Speech de Bienvenida
             **/
            Opciones_Speech::create([
                'tipo' => 1,
                'nombre' => $nombreSpeech->nombre,
                'speech_id_hijo' => $data['speech-inicial'],
                'speech_id' => $id
            ]);

            array_shift( $data );
            array_shift( $data );

            $info = array_chunk( $data, 2 );
            /**
             * Insertamos la información de las Opciones Speech
             **/
            for ($i=0; $i < count( $info ); $i++)
            {
                Opciones_Speech::create([
                        'tipo' => 0,
                        'nombre' => $info[$i][0],
                        'speech_id_hijo' => $info[$i][1],
                        'speech_id' => $id
                    ]);
            }
        }
        else
        {
            Speech::where( 'id', $id )->update(['texto' => $data['descripcionSpeech']]);
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
        Speech::where('id',$id)->update(['activo'=>0]);

        return redirect()->route('speech.index');
         /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Speech', $mensaje, $id);
    }
    /**
     * Función para obtener el texto que corresponde a la opción
     * de bienvenida
     */
    private function textoBienvenida($idOs )
    {
        return DB::table('Opciones_Speech AS OS')
            ->join('appLaravel.speech AS S', 'OS.speech_id_hijo', '=', 'S.id')
            ->select(
                'S.texto'
            )
            ->where('OS.id', $idOs)
            ->where('OS.tipo', 1)
            ->first();
    }
}
