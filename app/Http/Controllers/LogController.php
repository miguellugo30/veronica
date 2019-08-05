<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Nimbus\Logs;
use Illuminate\Support\Facades\Auth;

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
        $logs = Logs::all();
        return view('Logs.index', compact('logs'));
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store($accion, $tabla, $mensaje, $id)
    {
        Logs::create([
            'nivel'=>2,
            'accion'=>$accion,
            'tabla'=>$tabla,
            'id_registro'=>$id,
            'mensaje'=>$mensaje,
            'users_id'=>Auth::id(),
        ]);
    }
}
