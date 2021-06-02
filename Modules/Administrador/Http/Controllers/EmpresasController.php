<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
/* MODELOS */
use App\Empresas;
use App\Cat_Distribuidor;
use App\Almacenamiento;
use App\Canales;
use App\Dids;
use App\Cat_Extensiones;
use App\Token_Soporte;
use App\User;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /**
         * Recuperamos todos las empresas que esten activos
         */
        $empresas = Empresas::active()->get();
        return view('administrador::empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        /**
         * Recuperamos todos los distribuidores que esten activos
         */
        $distribuidores = Cat_Distribuidor::where('activo',1)->get();

        return view('administrador::empresas.create', compact('distribuidores') );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /**
         * Buscamos la empresa ha editar
         */
        $empresa = Empresas::active()->where('id', $id)->with('Config_Empresas')->first();
        /***
         * Buscamos los datos del Almacenamiento y Configuracion para la grafica
         */
        $inbound = Almacenamiento::active()->where('Empresas_id',$id)->sum('grabaciones_entrada');
        $outbound = Almacenamiento::active()->where('Empresas_id',$id)->sum('grabaciones_salida');
        $manual = Almacenamiento::active()->where('Empresas_id',$id)->sum('grabaciones_manuales');
        $buzon = Almacenamiento::active()->where('Empresas_id',$id)->sum('buzon_voz');
        $audios = Almacenamiento::active()->where('Empresas_id',$id)->sum('audios_empresa');

        $canales = Canales::active()->where('Empresas_id', $id)->with('Troncales')->get();
        $extensiones = Cat_Extensiones::active()->where('Empresas_id', $id)->with('Licencias')->get();
        $dids = Dids::active()->where('Empresas_id', $id)->get();

        return view(
                    'administrador::empresas.general',
                    compact(
                        'empresa',
                        'inbound',
                        'outbound',
                        'manual',
                        'buzon',
                        'audios',
                        'canales',
                        'extensiones',
                        'dids',
                    ));
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        /**
         * Buscamos la empresa ha editar
         */
        $empresa = Empresas::find($id);
        return view('administrador::empresas.empresa', compact('empresa'));
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Empresas::where( 'id', $id )->update(['activo' => 0]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('empresas.index');
    }

    public function generar_sesion( $id )
    {
        /**
         * Obtenemos los permisos del usuario de la empresa seleccionada
         */
        $user = Auth::user();
        /**
         * Obtenemos el usuario de soporte de la empresa
         */
        $usuarioSoporte = User::select('id', 'email', 'password')->where('email','like','soporte_'.$id.'%')->first();

        $tokenConsulta = Token_Soporte::where([ ['Empresas_id', '=', $id] , ['users_id_soporte','=',$usuarioSoporte->id] , ['users_id','=',$user->id] ])->get();

        if ( $tokenConsulta->isEmpty() )
        {
            $token = sha1( $user->email.$user->password.$id.date('d-m-YH:i:s') );
            $date = Carbon::now()->addHour(1);

            Token_Soporte::create([
                'token' =>   $token,
                'caducidad' => $date,
                'users_id_soporte' => $usuarioSoporte->id,
                'users_id' => $user->id,
                'Empresas_id' => $id
                ]);
        }
        else
        {
            $token =  $tokenConsulta[0]->token;
        }

        return $token;
    }
}
