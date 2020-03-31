<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Http\Requests\baseDatosRequest;
use Maatwebsite\Excel\Facades\Excel;
use DB;

use Nimbus\Imports\BaseDatosImport;

use Nimbus\Cat_Plantilla;
use Nimbus\Bases_Datos;
use Nimbus\Registros_base;
use Nimbus\Plantillas_campos;

class BaseDatosController extends Controller
{
    private $empresa_id;

    /**
     * Constructor para obtener el id empresa
     * con base al usuario que esta usando la sesion
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->empresa_id = Auth::user()->id_cliente;

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Obtenemos las bases de datos de la empresa
         */
        $dataBases = Bases_Datos::empresa( $this->empresa_id )->active()->with('Plantillas')->get();
        return view('settings::BaseDatos.index', compact('dataBases'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos las plantillas de la empresa
         */
        $plantillas = Cat_Plantilla::empresa( $this->empresa_id )->active()->get();

        return view('settings::BaseDatos.create', compact('plantillas') );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(baseDatosRequest $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', -1);
        /**
         * Creamos la base de datos
         */
        $baseDatos = Bases_Datos::create([
                                            'fk_empresas_id' => $this->empresa_id,
                                            'fk_cat_plantilla_id' => $request->plantilla,
                                            'nombre' => $request->nombre,
                                            'fecha_creacion' => date( 'Y-m-d H:i:s'),
                                        ]);
        /**
         * Obtenemos la plantilla seleccionada
         */
        $plantilla = Cat_Plantilla::where( 'id', $request->plantilla )->with('Plantillas_campos')->first();
        /**
         * Importamos la informacion del archivo adjunto
         */
        $data = new BaseDatosImport;
        Excel::import($data, $request->file('archivo_datos')->getRealPath() );
        /**
         * Validamos que los encabezados coincidan
         */
        $this->validarEncabezado( $plantilla->Plantillas_campos->sortBy('orden'), $data->data->first());
        /**
         * Quitamos el encabezado de la informacion importada
         */
        $data->data->shift();
        /**
         * Recorremos la informacion para poder insertar
         */
        $campos = $plantilla->Plantillas_campos->sortBy('orden');
        /**
         * Creamos el array con la informacion ha insertar
        */
        $dataArray = $this->arrayInsery($data, $campos, $baseDatos->id, $request->plantilla);

        $insert_data = collect($dataArray);
        $chunks = $insert_data->chunk(1000);

        foreach ($chunks as $chunk)
        {
            DB::table('Registros_base')->insert($chunk->toArray());
        }

        return redirect()->route('BaseDatos.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Obtenemos la base de datos a editar
         */
        $baseDatos = Bases_Datos::find($id);
        /**
         * Obtenemos los datos de la base de datos seleccionada
         **/
        $registros = DB::select( "call SP_Muestra_Base_Datos(".$baseDatos->fk_cat_plantilla_id.",".$id.")");
        /**
         * Obtenemos las plantillas que esta asociada a la base de datos
         */
        $plantilla = Cat_Plantilla::where( 'id', $baseDatos->fk_cat_plantilla_id )->with('Plantillas_campos')->first();
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */
        $campos = $this->campos( $plantilla, $this->campos_plantillas() );

        return view('settings::BaseDatos.show', compact('plantilla', 'registros', 'campos'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos la base de datos a editar
         */
        $baseDatos = Bases_Datos::find($id);
        /**
         * Obtenemos las plantillas que esta asociada a la base de datos
         */
        $plantilla = Cat_Plantilla::where( 'id', $baseDatos->fk_cat_plantilla_id )->with('Plantillas_campos')->first();
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */
        $campos = $this->campos_plantillas();

        return view('settings::BaseDatos.edit', compact('baseDatos', 'plantilla', 'campos'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        set_time_limit(0);
        ini_set('memory_limit', -1);
        //dd( $request );
        /**
         * Obtenemos la base de datos a editar
         */
        $baseDatos = Bases_Datos::find($id);
        /**
         * Obtenemos la plantilla seleccionada
         */
        $plantilla = Cat_Plantilla::where( 'id', $baseDatos->fk_cat_plantilla_id )->with('Plantillas_campos')->first();
        /**
         * Importamos la informacion del archivo adjunto
         */
        $data = new BaseDatosImport;
        Excel::import($data, $request->file('archivo_datos')->getRealPath() );
        /**
         * Validamos que los encabezados coincidan
         **/
        $this->validarEncabezado( $plantilla->Plantillas_campos->sortBy('orden'), $data->data->first());
        /**
         * Quitamos el encabezado de la informacion importada
         **/
        $data->data->shift();
        /**
         * Recorremos la informacion para poder insertar
         **/
        $campos = $plantilla->Plantillas_campos->sortBy('orden');
        /**
         * Creamos el array con la informacion ha insertar
         **/
        $dataArray = $this->arrayInsery($data, $campos, $id, $baseDatos->fk_cat_plantilla_id);

        $insert_data = collect($dataArray);
        $chunks = $insert_data->chunk(1000);

        if ( $request->accion == 1 )
        {
            foreach ($chunks as $chunk)
            {
                DB::table('Registros_base')->insert($chunk->toArray());
            }
        }
        elseif( $request->accion == 2 )
        {
        }
        elseif( $request->accion == 3 )
        {
            Registros_base::where('fk_bases_datos',$id)->update(['activo'=> 0]);
            foreach ($chunks as $chunk)
            {
                DB::table('Registros_base')->insert($chunk->toArray());
            }
        }


        return redirect()->route('BaseDatos.index');
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
    /***
     * Funcion que se encarga en validar si el numero de campos en el encabezado
     * es el mismo con los de la plantilla
     */
    private function validarEncabezado($camposPlantilla, $camposArchivo)
    {
        if ( count( $camposPlantilla ) == count( $camposArchivo ) ) {
            return 1;
        } else {
            return abort(403, 'El contenido no coincide con la plantilla seleccionada.');;
        }
    }
    /**
     * Funcion para crear el array para hacer la insercion
     */
    private function arrayInsery( $data, $campos, $idBaseDatos, $plantilla )
    {
        $dataArray = [];
        $fecha_registro = date( 'Y-m-d H:i:s');

        foreach ($data->data as $key ) {

            $i = 0;
            foreach ($key as $v) {

                $data = array(
                    'fk_cat_campos_plantilla_id' => $campos[$i]->fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id,
                    'fk_cat_plantilla_id' => $plantilla,
                    'fk_bases_datos' => $idBaseDatos,
                    'valor' => $v,
                    'fecha_registro' => $fecha_registro
                );

                $dataArray[] = $data;

                $i++;
            }
        }

        return $dataArray;
    }
    /**
     * Funcion para obtener los campos que se tiene
     * asigando a la empresa
     */
    public function campos_plantillas()
    {
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */
        $campos = DB::table('Cat_campos_plantillas')
                    ->select('Cat_campos_plantillas.id', 'Cat_campos_plantillas.nombre')
                    ->join('Campos_plantillas_empresa', 'Campos_plantillas_empresa.fk_cat_campos_plantilla_id', '=', 'Cat_campos_plantillas.id')
                    ->where('Campos_plantillas_empresa.fk_empresas_id', $this->empresa_id)
                    ->get();

        return $campos;
    }
    /**
     * Funcion para obtener los campos que se usan en la plantilla
     */
    public function campos( $plantilla, $campos )
    {
        $data = [];

        foreach ($plantilla->Plantillas_campos->sortBy('orden') as $campo)
        {
            foreach ($campos as $v)
            {
                if ($v->id == $campo->fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id)
                {
                     array_push($data, $v->nombre);
                }
            }
        }
        return $data;
    }
}
