<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Nimbus\User;
use Nimbus\PrefijosMarcacion;
use Nimbus\Perfiles;
use Nimbus\Canales;
use Nimbus\Dids;
use Nimbus\Perfil_Marcacion;
use Nimbus\Cat_Tipo_Canales;
use DB;
use Nimbus\Http\Controllers\LogController;
use Modules\Settings\Http\Requests\PerfilMarcacionRequest;

class PerfilMarcacionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Recuperamos todos los Perfiles que esten activos
         */
        $perfiles = Perfiles::active()->where('fk_empresas_id',$empresa_id)->get();

        return view('administrador::perfil_Marcacion.index', compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        /**
         * Recuperamos todos los prefijos de la empresa
         */
        $prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$id)->get();
        /**
         * Obtenemos los canales de la empresa
         */
        $canales= Canales::active()->where('Empresas_id',$id)->with('Cat_Tipo_Canales')->get();
        /**
         * Obtenemos los did's de la empresa
         */
        $did= Dids::active()->where('Empresas_id',$id)->get();

        return view('administrador::perfil_Marcacion.create', compact('id','prefijos','canales','did'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /**
         * Creamos los datos del formulario en la tabla Prefijos_Marcacion
         */
        $perfiles = Perfiles::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fk_empresas_id' => $request->input('id'),
            'activo' => 1
        ]);
        /**
         * Creamos los datos del Formulario en la tabla Perfil_marcacion
         */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Perfil_Marcacion::create([
            'fk_prefijos_marcacion_id' => $request->prefijo,
            'fk_perfiles_id' => $perfiles->id,
            'fk_canales_id' => $request->canal,
            'fk_dids_id' => $request->did,
            'activo' => 1
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Perfiles',$mensaje, $request->input('id'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($idEmpresa)
    {
        /**
         * Obtenemos todos los perfiles de marcacion
         */
        $perfil_marcacion = Perfil_Marcacion::active()->with('PrefijosMarcacion')
        ->whereHas('PrefijosMarcacion', function($query) use ($idEmpresa)  {
            $query->where('fk_empresas_id', $idEmpresa);
        })->with('Perfiles')->whereHas('Perfiles', function($query) use ($idEmpresa)  {
            $query->where('fk_empresas_id', $idEmpresa);
        })->with('Canales')->whereHas('Canales', function($query) use ($idEmpresa)  {
            $query->where('Empresas_id', $idEmpresa);
        })->with('Dids')->whereHas('Dids', function($query) use ($idEmpresa)  {
            $query->where('Empresas_id', $idEmpresa);
        })->get();
        /**
         * Recuperamos todos los prefijos de la empresa
         */
        $prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$idEmpresa)->get();
        /**
         * Obtenemos los canales de la empresa
         */
        $canales= Canales::active()->where('Empresas_id',$idEmpresa)->with('Cat_Tipo_Canales')->get();
        /**
         * Obtenemos los did's de la empresa
         */
        $did= Dids::active()->where('Empresas_id',$idEmpresa)->get();

        return view('administrador::perfil_marcacion.show', compact('idEmpresa','perfil_marcacion','prefijos','canales','did'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('administrador::perfil_marcacion.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count($dataForm); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 6);

        for ($i=0; $i < count($info); $i++) {
            Perfiles::where([
                ['id','=',$info[$i][0]],
                ['fk_empresas_id','=',$id],
            ])->update([
                'nombre' => $info[$i][1],
                'descripcion' => $info[$i][2],
                'activo' => 1
            ]);
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            Perfil_Marcacion::active()->where('fk_perfiles_id',$info[$i][0])->update([
                'fk_prefijos_marcacion_id' => $info[$i][3],
                'fk_canales_id' => $info[$i][4],
                'fk_dids_id' => $info[$i][5],
            ]);
            /**
             * Creamos el logs
             */
            $mensaje = 'Se edito un registro con id: '.$info[$i][0].', informacion editada: '.var_export($info[$i], true);
            $log = new LogController;
            $log->store('Actualizacion', 'Perfiles',$mensaje, $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Actualizamos el prefijo a activo 0
         */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Perfil_Marcacion::active()->where('fk_perfiles_id', $id)->update([
            'activo' => 0
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Perfil_marcacion', $mensaje, $id);
    }
}
