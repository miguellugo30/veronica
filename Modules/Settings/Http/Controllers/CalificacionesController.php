<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\Calificaciones; ##---confirma?
use Nimbus\Grupos;
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
        
        $id = '3';
        $formularios = Formularios::where('Cat_Tipo_Marcacion_id',$id)-> active()->get();
       
        return view('settings::Calificaciones.create', compact('TipoMarcacion','formularios'));
      # return view('settings::Calificaciones.create', compact('TipoMarcacion'));
    }
    
  ####-------------------  GUARDAR NUEVOS ITEMS ------------###
    public function store(Request $request)
    {
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
             $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value']; 
         //  $data[ $dataForm[$i]['name']."_".$i ] = $dataForm[$i]['value'];
        }

         /**
         * Obtenemos los datos del usuario logeado
         */
        $user = User::find( Auth::id() );
        $empresa_id = $user->id_cliente;
        /** Datos del Grupo **/
        $tipo_grupo = 'Calificaciones';
        $desc = 'Grupo de Calificaciones';
       
        /**
         * Insertar información el table de Formularios
         */
         $grupo = Grupos::create([
             'nombre'=> $data['nombre_grupo'], 
             'descripcion'=>$desc,
             'tipo_grupo'=>$tipo_grupo,             
             'Empresas_id'=>$empresa_id
             ]);

        $tipo_marcacion = $data['tipo_marcacion']; 
        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 4 );
    
        /** * Insertamos la información de los campos  **/


       for ($i=0; $i < count( $info ); $i++) {            
   
            $campo = Calificaciones::create([
                      'nombre' => $info[$i][0],
                      'tipo_marcacion' => $tipo_marcacion,
                      'Formularios_id' => $info[$i][1]
                     ]);                     
#dd($info[$i]);  
      }
     
/*
      DB::table('Formularios_Campos')->insert(
                ['Formularios_id' => $formulario->id, 'Campos_id' => $campo->id]
            );
 */           

                      

        return redirect()->route('calificaciones.index');
    }


       
    ###----------------------    
    
    public function show($tipo)
    {
        ## Validar despues la Empresa
        
        ## /**Devolvemos la informacion de los canales de la empresa
        $formularios = Formularios::where('Cat_Tipo_Marcacion_id',$id)-> active()->get();        
      
     #   return view('settings::Calificaciones.show', compact('TipoMarcacion','formularios'));
        return view('settings::Calificaciones.create', compact('TipoMarcacion','formularios'));
    }
    ##----------------------|
   
    /**
    *  Actualiza el valor active || Borrado logico ok
    *  @param int $id
    *  @return Response
    */
    public function destroy($id)
    {
        Calificaciones::where('id',$id)
        ->update(['activo'=>'0']);

        return redirect()->route('calificaciones.index');
    }
    
    
    
    public function edit($id)
    {       
        
        $calificacion = Calificaciones::find( $id );
        dd($calificacion);
       
        $id = '3';
        
        $formularios = Formularios::where('Grupo_Calificaciones_id',$calificacion->Formularios_id);
        $grupos = Grupos::where('');
        
        

       # $formulario = $formulario->Formularios;        
       # $grupo = Grupos::find($id_gpo)         
        #$TipoMarcacion = array(['nombre']); 
         //Cat_Tipo_Marcacion::all();

        
        return view('settings::Calificaciones.edit', compact('calificaciones'));
    }

    

}

