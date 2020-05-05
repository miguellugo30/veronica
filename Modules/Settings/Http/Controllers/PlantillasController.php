<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\Cat_Plantilla;
use Nimbus\Plantillas_campos;
use Nimbus\Http\Controllers\LogController;
use DB;

class PlantillasController extends Controller
{

    protected $empresa_id;

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
         * Obtenemos las plantillas de la empresa
         */
        $plantillas = Cat_Plantilla::empresa( $this->empresa_id )->active()->get();

        return view('settings::Plantillas.index', compact('plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */
        $campos = $this->campos_plantillas();

        return view('settings::Plantillas.create', compact('campos'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->dataForm;
        $nombrePlantilla = $data['nombre'];
        array_shift( $data );
        array_shift( $data );
        /**
         * Insertar información de la plantilla
         **/
         $plantilla = Cat_Plantilla::create([
                                            'nombre' => $nombrePlantilla,
                                            'fk_empresas_id' => $this->empresa_id
                                            ]);
        $info = array_chunk( $data, 4 );
        /**
         * Insertamos la información de los campos
         **/
        $j = 1;
        for ($i=0; $i < count( $info ); $i++) {

            Plantillas_campos::create([
                            'fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id' => (int)$info[$i][0],
                            'fk_campos_plantilla_empresa_empresas_id' => $this->empresa_id,
                            'fk_cat_plantilla_id' =>  $plantilla->id,
                            'editable' => (int)$info[$i][3],
                            'marcar' => (int)$info[$i][1],
                            'mostrar' => (int)$info[$i][2],
                            'orden' => (int)$j
                        ]);
            $j++;
        }

        /**
         * Creamos el logs
         */
        //$mensaje = 'Se creo un nuevo registro, información capturada: '.var_export($request->dataForm, true);
        //$log = new LogController;
        //$log->store('Inserción', 'Cat_Plantilla', $mensaje, '');


        return redirect()->route('Plantillas.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Obtenemos las plantillas de la empresa
         */
        $plantilla = Cat_Plantilla::with('Plantillas_campos')->where( 'id', $id )->active()->first();
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */
        $campos = $this->campos_plantillas();

        return view('settings::Plantillas.show', compact('campos', 'plantilla'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos las plantillas de la empresa
         */
        $plantilla = Cat_Plantilla::with('Plantillas_campos')->where( 'id', $id )->active()->first();
        /**
         * Obtenemos todos los campos que estan asignados a la empresa
         */
        $campos = $this->campos_plantillas();

        return view('settings::Plantillas.edit', compact('campos', 'plantilla'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->data;
        $nombrePlantilla = $data['nombre'];
        array_shift( $data );
        /**
         * Eliminamos los campos de la plantilla
         */
        Plantillas_campos::where( 'fk_cat_plantilla_id', $id )->delete();
        /**
         * Actualizamos el nombre de la plantilla
         */
        Cat_Plantilla::where( 'id', $id )->update( ['nombre' => $nombrePlantilla ]);
        /**
         * Insertamos los nuevos campos de la plantilla
         */
        $info = array_chunk( $data, 4 );
        $j = 1;
        for ($i=0; $i < count( $info ); $i++) {

            Plantillas_campos::create([
                'fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id' => (int)$info[$i][0],
                            'fk_campos_plantilla_empresa_empresas_id' => $this->empresa_id,
                            'fk_cat_plantilla_id' =>  $id,
                            'editable' => (int)$info[$i][3],
                            'marcar' => (int)$info[$i][1],
                            'mostrar' => (int)$info[$i][2],
                            'orden' => (int)$j
                            ]);
            $j++;
        }

        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', información editada: '.var_export( $request->data, true);
        $log = new LogController;
        $log->store('Actualización', 'Plantillas_campos', $mensaje, $id);

        return redirect()->route('Plantillas.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos el nombre de la plantilla
         */
        Cat_Plantilla::where( 'id', $id )->update( ['activo' => 0 ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminación', 'Cat_Plantilla', $mensaje, $id);

        return redirect()->route('Plantillas.index');
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
}
