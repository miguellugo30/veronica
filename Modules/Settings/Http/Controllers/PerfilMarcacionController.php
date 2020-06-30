<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PrefijosMarcacion;
use App\Perfiles;
use App\Canales;
use App\Dids;
use App\Perfil_Marcacion;
use App\Cat_Tipo_Canales;
use DB;
use App\Http\Controllers\LogController;
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
         * Obtenemos todos los perfiles de marcacion
         */
        $perfil_marcacion = Perfil_Marcacion::active()->with('PrefijosMarcacion')->whereHas('PrefijosMarcacion', function($query) use ($empresa_id)  {
            $query->where('fk_empresas_id', $empresa_id);
        })->with('Perfiles')->whereHas('Perfiles', function($query) use ($empresa_id)  {
            $query->where('fk_empresas_id', $empresa_id);
        })->with('Canales')->whereHas('Canales', function($query) use ($empresa_id)  {
            $query->where('Empresas_id', $empresa_id);
        })->with('Dids')->whereHas('Dids', function($query) use ($empresa_id)  {
            $query->where('Empresas_id', $empresa_id);
        })->get();
        //dd($perfil_marcacion);

        return view('settings::Perfil_Marcacion.index', compact('perfil_marcacion'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        /**
         * Recuperamos todos los prefijos de la empresa
         */
        $prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$empresa_id)->get();
        /**
         * Obtenemos los canales de la empresa
         */
        $canales= Canales::active()->where('Empresas_id',$empresa_id)->with('Cat_Tipo_Canales')->get();
        /**
         * Obtenemos los did's de la empresa
         */
        $did= Dids::active()->where('Empresas_id',$empresa_id)->get();

        return view('settings::Perfil_Marcacion.create',compact('prefijos','canales','did'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PerfilMarcacionRequest $request)
    {
        /**
         * Insertamos la información del Perfil
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $perfiles = Perfiles::create([
            'nombre'=> $request->nombre,
            'descripcion'=>$request->descripcion,
            'fk_empresas_id'=>$empresa_id,
            'activo'=> 1
            ]);
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
        $log->store('Insercion', 'Perfiles',$mensaje, $empresa_id);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('Perfil_Marcacion.index');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos el id empresa del usuario para obtener los prefijos
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;
        $perfiles = Perfiles::active()->where('id',$id)->first();
        /**
         * Obtenemos los prefijos de la empresa
         */
        $prefijos = PrefijosMarcacion::active()->where('fk_empresas_id',$empresa_id)->get();
        /**
         * Obtenemos los canales de la empresa
         */
        $canales = Canales::active()->where('Empresas_id',$empresa_id)->with('Cat_Tipo_Canales')->get();
        /**
         * Obtenemos todos los Did's de la empresa
         */
        $did = Dids::active()->where('Empresas_id',$empresa_id)->get();
        /**
         * Obtenemos todos los perfiles de marcacion
         */
        $perfil_marcacion = Perfil_Marcacion::active()->where('fk_perfiles_id',$id)->first();

        return view('settings::Perfil_Marcacion.edit',compact('perfiles','prefijos','canales','did','perfil_marcacion'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PerfilMarcacionRequest $request, $id)
    {
        /**
         * Obtenemos el id empresa del usuario para actualizar los perfiles
         */
        $user = Auth::user();
        $empresa_id = $user->id_cliente;

        Perfiles::active()->where('id',$id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fk_empresas_id' => $empresa_id,
            'activo' => 1
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Perfil_Marcacion::active()->where('fk_perfiles_id', $id)->update([
            'fk_prefijos_marcacion_id' => $request->prefijo,
            'fk_canales_id' => $request->canal,
            'fk_dids_id' => $request->did,
            'activo' => 1
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se edito un registro con id: '.$id.', informacion editada: '.var_export($request->all(), true);
        $log = new LogController;
        $log->store('Actualizacion', 'Perfiles',$mensaje, $id);

        return redirect()->route('Perfil_Marcacion.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Perfil_Marcacion::active()->where('fk_perfiles_id', $id)->update([
            'activo' => 0
        ]);
        /**
         * Creamos el logs
         */
        $mensaje = 'Se Elimino un registro con id: '.$id;
        $log = new LogController;
        $log->store('Eliminacion', 'Perfiles', $mensaje, $id);

        return redirect()->route('Perfil_Marcacion.index');
    }
}
