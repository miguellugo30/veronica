<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Nimbus\Logs;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Nimbus\Token_Soporte;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos los logs
         */
        $logs = Logs::with('Usuarios')->get();
        return view('Logs.index', compact('logs'));
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store($accion, $tabla, $mensaje, $id)
    {

        $user = Auth::user();
        $id_user = $user->id;
        $pos = Str::contains($user->email, 'soporte_');

        if ( $pos === true )
        {
            $id_user = session('user_real');
            $mensaje = "Usando la cuenta de soporte ".$mensaje;
        }

        Logs::create([
            'nivel'=>2,
            'accion'=>$accion,
            'tabla'=>$tabla,
            'id_registro'=>$id,
            'mensaje'=>$mensaje,
            'users_id'=>$id_user,
        ]);
    }
}
