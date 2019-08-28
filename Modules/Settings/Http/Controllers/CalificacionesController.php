<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Calificaciones;
#use Nimbus\Grupo_Calificacion;
use Nimbus\Cat_Tipo_Marcacion;
use Nimbus\Formularios;

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

    public function create()
    {
        /**
        ## Obtener los tipos de marcacion para el tipo de formulario
        **/     
      #  $GrupoCalificacion = Grupo_Calificacion::all();
        $TipoMarcacion = Cat_Tipo_Marcacion::all();     
        
        $id = 3;
        $formularios = Formularios::where('Cat_Tipo_Marcacion_id',$id)-> active()->get();
         
        #return view('settings::Calificaciones.create', compact('GrupoCalificacion','TipoMarcacion','formularios'));:12:
        return view('settings::Calificaciones.create', compact('TipoMarcacion','formularios'));
    }
    

}

