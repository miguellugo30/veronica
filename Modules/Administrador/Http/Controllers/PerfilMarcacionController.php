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
        /**
         * Obtenemos todos los Perfiles de marcacion
         */
        $perfil_marcacion = Perfil_Marcacion::active()->with('PrefijosMarcacion')->with('Perfiles')->with('Canales')->with('Dids')->get();

        return view('administrador::perfil_Marcacion.index', compact('perfil_marcacion'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        /**
         * Obtenemos todos los Prefijos
         */
        $prefijos = PrefijosMarcacion::active()->get();
        /**
         * Obtenemos todos los Perfiles
         */
        $perfiles = Perfiles::active()->get();
        /**
         * Obtenemos todos los Canales
         */
        $canales = Canales::active()->with('Cat_Tipo_Canales')->get();
        /**
         * Obtenemos todos los Dids
         */
        $did = Dids::active()->get();

        return view('administrador::perfil_Marcacion.create', compact('prefijos','perfiles','canales','did','id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $perfil_marcacion = Perfil_Marcacion::create([
            'fk_prefijos_marcacion_id' => $request->prefijo,
            'fk_perfiles_id' => $request->perfil,
            'fk_canales_id' => $request->canal,
            'fk_dids_id' => $request->did,
            'activo' => 1
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se creo un nuevo registro, informacion capturada:'.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Insercion', 'Perfil_marcacion',$mensaje, $perfil_marcacion->id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('perfil_marcacion.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $idEmpresa)
    {
        /**
         * Obtenemos todos los Perfiles de marcacion
         */
        $perfil_marcacion = Perfil_Marcacion::active()->with('PrefijosMarcacion')->with('Perfiles')->with('Canales')->with('Dids')->get();
        /**
         * Obtenemos todos los Prefijos
         */
        $prefijos = PrefijosMarcacion::active()->get();
        /**
         * Obtenemos todos los Perfiles
         */
        $perfiles = Perfiles::active()->get();
        /**
         * Obtenemos todos los Canales
         */
        $canales = Canales::active()->with('Cat_Tipo_Canales')->get();
        /**
         * Obtenemos todos los Dids
         */
        $did = Dids::active()->get();

        return view('administrador::perfil_marcacion.show', compact('idEmpresa','perfil_marcacion','prefijos','perfiles','canales','did'))->withRequest($request);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        return view('administrador::perfil_marcacion.edit',compact('prefijos','perfiles','canales','did'))->withRequest($request);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $perfil_marcacion = Perfil_Marcacion::active()->get();

        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count($dataForm); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        array_shift( $data );
        array_shift( $data );
        array_shift( $data );

        $info = array_chunk( $data, 5);

        for ($i=0; $i < count($info); $i++) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            Perfil_Marcacion::where([
                ['fk_prefijos_marcacion_id','=',$perfil_marcacion[$i]['fk_prefijos_marcacion_id']],
                ['fk_perfiles_id','=',$perfil_marcacion[$i]['fk_perfiles_id']],
                ['fk_canales_id','=',$perfil_marcacion[$i]['fk_canales_id']],
                ['fk_dids_id','=',$perfil_marcacion[$i]['fk_dids_id']],
                ['activo','=',1],
            ])->update([
                'fk_prefijos_marcacion_id' => $info[$i][1],
                'fk_perfiles_id' => $info[$i][2],
                'fk_canales_id' => $info[$i][3],
                'fk_dids_id' => $info[$i][4],
                'activo' => 1
            ]);
        }
        /*
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Perfil_Marcacion::active()->where([
            ['fk_prefijos_marcacion_id','=',$request->prefijo],
            ['fk_perfiles_id','=',$request->perfil],
            ['fk_canales_id','=',$request->canal],
            ['fk_dids_id','=',$request->did],
        ])
        ->update([
            'fk_prefijos_marcacion_id' => $request->prefijo2,
            'fk_perfiles_id' => $request->perfil2,
            'fk_canales_id' => $request->canal2,
            'fk_dids_id' => $request->did2,
            'activo' => 1
        ]);
        */
        /**
         * Creamos el logs
         */
        /*
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Perfil_marcacion',$mensaje, $id);
        */

        return redirect()->route('perfil_marcacion.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        /**
         * Actualizamos el Perfil a activo 0
         */
        /*
         Perfil_Marcacion::where('fk_dids_id',$id)->update([
            'activo' => 0,
        ]);
        */
        Perfil_Marcacion::where([
            ['fk_prefijos_marcacion_id','=',$request->prefijo],
            ['fk_perfiles_id','=',$request->perfil],
            ['fk_canales_id','=',$request->canal],
            ['fk_dids_id','=',$request->did],
        ])->update([
            'activo' => 0,
        ]);

    }
}
