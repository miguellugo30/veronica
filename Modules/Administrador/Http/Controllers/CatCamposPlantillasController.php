<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Cat_Campos_Plantillas;
use App\Empresas;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;
use Modules\Administrador\Http\Requests\CamposPlantillasRequest;

class CatCamposPlantillasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cat_campos_plantillas = Cat_Campos_Plantillas::with('Empresas')->get();

        return view('administrador::cat_campos_plantillas.index', compact('cat_campos_plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Obtenemos todas las empresas
         */
        $Empresas = Empresas::active()->get();

        return view('administrador::cat_campos_plantillas.create', compact('Empresas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CamposPlantillasRequest $request)
    {
        /**
         * Obtenemos todos los datos del formulario de alta e
         * insertamos la informacion del formulario
         */
        $cat = Cat_Campos_Plantillas::create(  $request->all() );
        /**
         * Buscamos la empresa
         */
        $empresa = Empresas::findOrFail($request->empresa);
        /**
         * Vinculamos los campos con la empresa
         */
        //$empresa->Cat_campos_plantillas()->attach($cat);
        for ($i=0; $i < count($empresa); $i++) {
            DB::table('Campos_plantillas_empresa')->insert([
                'fk_cat_campos_plantilla_id' => $cat->id,
                'fk_empresas_id' => $request->empresa[$i]
            ]);
        }
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Cat_campos_plantillas',$mensaje, $cat->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_campos_plantillas.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administrador::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Consultamos las empresas que tienen asignados los campos plantilla
         */
        $EmpresasAdd = DB::table('Campos_plantillas_empresa')->where('fk_cat_campos_plantilla_id',$id)->get();
        /**
         * Extraemos los ID,s de las empresas que estan asociadas para posterior consultarlas
         */
        $emps = array();
        for ($i=0; $i < count($EmpresasAdd); $i++) {
            array_push($emps,$EmpresasAdd[$i]->fk_empresas_id);
        }
        /**
         * Obtenemos todas las empresas que estan asociadas
         */
        $Empresas = Empresas::active()->whereIn('id',$emps)->get();
        /**
         * Obtenemos todas las empresas que no estan asociadas
         */
        $Empresas2 = Empresas::active()->whereNotIn ('id',$emps)->get();
        /**
         * Obtenemos la informacion del catalogo a editar
         */
        $cat_campos_plantillas = Cat_Campos_Plantillas::findOrFail( $id );

        return view('administrador::cat_campos_plantillas.edit', compact('Empresas','Empresas2','cat_campos_plantillas', 'id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CamposPlantillasRequest $request, $id)
    {
        /**
         * Actualizamos los campos en la tabla Cat_Campos_Plantillas
         */
        Cat_Campos_Plantillas::where( 'id', $id )
        ->update([
            'nombre' => $request->input('nombre')
        ]);
        /**
         * Buscamos las empresa
         */
        $empresa = Empresas::findOrFail($request->empresa);
        /**
         * Extraemos los ID,s de las empresas que estan asociadas para posterior consultarlas
         */
        $empr = array();
        for ($i=0; $i < count($empresa); $i++) {
            array_push($empr,$empresa[$i]->id);
        }

        /**
         * Borramos los campos de la tabla Campos_plantillas_empresa
         */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('Campos_plantillas_empresa')->where('fk_cat_campos_plantilla_id',$id)->delete();
        /**
         * Vinculamos los campos con la empresa
         */
        for ($i=0; $i < count($empr); $i++) {
            DB::table('Campos_plantillas_empresa')->insert([
                'fk_cat_campos_plantilla_id' => $id,
                'fk_empresas_id' => $request->empresa[$i]
            ]);
        }
        /**
         * Creamos el logs
         */
        $mensaje = 'Se actualizo un registro con id: '.$id.', informacion actualizada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Cat_campos_plantillas',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_campos_plantillas.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Borramos los campos de la tabla Campos_plantillas_empresa
         */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('Campos_plantillas_empresa')->where('fk_cat_campos_plantilla_id',$id)->delete();
        /**
         * Borramos los campos de la tabla Cat_Campos_Plantillas
         */
        Cat_Campos_Plantillas::where( 'id', $id )
        ->delete();
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Cat_campos_plantillas',$mensaje, $id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cat_campos_plantillas.index');
    }
}
