<?php

namespace Modules\Recording\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use App\User;
use App\Categorias;
use Illuminate\Support\Facades\Auth;
use App\Grabaciones;


class GrabacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos los datos del usuario Logueado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /**
         * Obtenemos el rol del usuario logueado
         */
        $rol = $user->getRoleNames();
        /**
         * Obtenemos las categorias relacionadas al usuario
         */
        $categorias = Categorias::active()->where('modulos_id', 4)->get();
        $modulo = "Recording";
        //$grabaciones = Grabaciones::active()->where('Empresas_id', $empresa_id)->get();
        $grabaciones = Grabaciones::find($empresa_id, 'Empresas_id')->get();

        /** Consumir WS desde el MS para enviar el audio **/
        $url = '10.255.242.136/audios/upload_audios.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "empresa_id=".$empresa_id."&accion=1"."&id=" . $user->id_cliente);
        $remote_server_output = curl_exec($ch);
        $error = curl_errno($ch);
        curl_close ($ch);

        return view('recording::Grabaciones.index', compact( 'rol', 'categorias', 'modulo', 'grabaciones' ) );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('recording::Grabaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('recording::Grabaciones.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('recording::Grabaciones.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
