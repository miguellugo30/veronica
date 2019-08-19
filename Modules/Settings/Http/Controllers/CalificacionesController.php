<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Calificaciones;

class CalificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */   
    public function index()
    {
        $calificaciones = Calificaciones::active()->get();  // Esta haciendo referencia >>> al Modelo
        return view('settings::Calificaciones.index',compact('calificaciones'));

    }

    

}

