<?php

namespace Modules\Inbound\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Http\Controllers\LogController;
use Nimbus\Campanas;
use Nimbus\Audios_Empresa;
use Nimbus\Campanas_Configuracion;

class CampanasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        $campanas= Campanas::active()->where('Empresas_id',$empresa_id)->get();

        return view('inbound::campanas.index',compact('campanas'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $Audios = Audios_Empresa::active()->where([['Empresas_id',$empresa_id],['musica_en_espera','=','0'],])->get();
        $Mohs= Audios_Empresa::active()->where([['Empresas_id',$empresa_id],['musica_en_espera','=','1'],])->get();
        //dd($Audios);
        return view('inbound::campanas.create', compact('Audios','Mohs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Insertar información el table de Formularios
         */
        $campana = Campanas::create(
            [
                'nombre' => $request->input('nombre'),
                'modalidad_logue' => $request->input('mlogeo'),
                'id_grabacion' =>  $request->input('msginical') ,
                'tipo_marcacion' => 'Inbound',
                //'id_speech' =>  $request->input('script') ,
                'time_max_sonora' =>  $request->input('alertstll') ,
                'time_max_llamada' =>  $request->input('alertstdll') ,
                'time_liberacion' =>  $request->input('libta') ,
                'Empresas_id'   => $empresa_id
            ]
        );
        Campanas_Configuracion::create(
            [
                'name' =>  $campana->id,
                'periodic_announce' => $request->input('periodic_announce'),
                'periodic_announce_frequency' =>  $request->input('periodic_announce_frequency') ,
                'wrapuptime' => $request->input('wrapuptime'),
                'strategy' =>  $request->input('strategy'),
                'Campanas_id'   => $campana->id
            ]
        );
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'User',$mensaje, $user->id);

        return redirect()->route('campanas.index');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('inbound::campanas.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $campana= Campanas::where('id',$id)->first();
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;

        $Audios = Audios_Empresa::active()->where([['Empresas_id',$empresa_id],['musica_en_espera','=','0'],])->get();

        return view('inbound::campanas.edit',compact('campana','Audios'));
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
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );

        Campanas::where('id', $id)->update([
                                            'nombre' => $request->input('nombre'),
                                            'modalidad_logue' => $request->input('mlogeo'),
                                            'id_grabacion' =>  $request->input('msginical') ,
                                            'tipo_marcacion' => 'Inbound',
                                            //'id_speech' =>  $request->input('script') ,
                                            'time_max_sonora' =>  $request->input('alertstll') ,
                                            'time_max_llamada' =>  $request->input('alertstdll') ,
                                            'time_liberacion' =>  $request->input('libta')
                                        ]);

        Campanas_Configuracion::where('Campanas_id', $id)->update([
                                            'periodic_announce' => $request->input('periodic_announce'),
                                            'periodic_announce_frequency' =>  $request->input('periodic_announce_frequency') ,
                                            'wrapuptime' => $request->input('wrapuptime'),
                                            'strategy' =>  $request->input('strategy')
                                        ]);

        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un actualizo registro, informacion actualizada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Camapanas',$mensaje, $user->id);

        return redirect()->route('campanas.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    /**
     * Evento para eliminar una campana
     */
    public function destroy($id)
    {
        //dd($id);
        Campanas::where('id',$id)
        ->update(['activo'=>'0']);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'User', $mensaje, $id);

        return redirect()->route('campanas.index');
    }
}
