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
    
  ####-------------------  
    public function store(Request $request)
    {
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
           $data[ $dataForm[$i]['name']."_".$i ] = $dataForm[$i]['value'];
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
             'nombre'=> $dataForm['nombre_grupo'], 
             'descripcion'=>$desc,
             'tipo_grupo'=>$tipo_grupo,             
             'Empresas_id'=>$empresa_id
             ]);

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 6 );

        /**
         * Insertamos la información de los campos
         */

        for ($i=0; $i < count( $info ); $i++) {

            if ( $info[$i][1] == 'asignador_folios' ) {

                $folio = array();
                $b =  explode( '&', $info[$i][5]);
                for ($j=0; $j < count($b); $j++) {
                    $c = explode('=',$b[$j]);
                    array_push( $folio, $c[1] );
                }

               $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4],
                                            'prefijo' => $folio[0],
                                            'folio' => $folio[1]
                                        ]);
            } else if ( $info[$i][1] == 'select' ) {

                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4]
                                        ]);

                $b =  explode( '&', $info[$i][5]);
                $k = 0;
                for ($j=0; $j < ( count($b) / 2 ); $j++) {
                    $c = explode('=',$b[$k]);
                    $d = explode('=',$b[$k + 1]);

                    Sub_Formularios::create([
                        'opcion' => urldecode( $c[1] ),
                        'texto' => urldecode( $c[1] ),
                        'Formularios_id' => $d[1],
                        'Campos_id' =>$campo->id
                    ]);

                    $k = $k + 2;
                }

            } else {
                $campo = Campos::create([
                                            'nombre_campo' => $info[$i][0],
                                            'tipo_campo' => $info[$i][1],
                                            'tamano' => $info[$i][2],
                                            'obligatorio' => $info[$i][3],
                                            'editable' => $info[$i][4]
                                        ]);
            }

      DB::table('Formularios_Campos')->insert(
                ['Formularios_id' => $formulario->id, 'Campos_id' => $campo->id]
            );

        }

        return redirect()->route('calificaciones.index');
    }

                                                      
    
    
    ###-------------------
    
    
    public function show($tipo)
    {
        ## Validar despues la Empresa
        
        ## /**Devolvemos la informacion de los canales de la empresa
        $formularios = Formularios::where('Cat_Tipo_Marcacion_id',$id)-> active()->get();        
      
     #   return view('settings::Calificaciones.show', compact('TipoMarcacion','formularios'));
        return view('settings::Calificaciones.create', compact('TipoMarcacion','formularios'));
    }

    
    
    

}

