<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use Nimbus\Http\Controllers\ZonaHorariaController;
use Carbon\Carbon;
use DB;

use Nimbus\Agentes;
use Nimbus\Miembros_Campana;
use Nimbus\Crd_Asignacion_Agente;
use Nimbus\HistorialEventosAgentes;

class AgentesLoginController extends Controller
{

    use AuthenticatesUsers;

    protected $guard = 'agentes';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/agentes';
    private $agente;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        /**
         * Obtenemos la fecha, formateada, con la zona horaria
         */
        $this->middleware(function ($request, $next) {
            $this->agente = auth()->guard('agentes')->user();

            return $next($request);
        });
    }
    /**
     * Funcion para mostrar el formulario de inicio de sesion para el agente
     */
    public function showAgentesLoginForm()
    {
        return view('vendor.adminlte.login_agente', ['url' => 'agentes'] );
    }
    /**
     * Funcion para generar el inicio de sesion
     * Valida si no existe ya una sesion
     * Si no se manda la pantalla para confirmar la extension
     */
    public function agentesLogin(Request $request)
    {
        if (auth()->guard('agentes')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            //$fecha = $this->zona_horaria( auth()->guard('agentes')->id() );
            $fecha = ZonaHorariaController::zona_horaria_agente( auth()->guard('agentes')->id() );
            $v = DB::select("CALL SP_Inserta_Estado_Agentes(".auth()->guard('agentes')->id().",'$fecha')");
            /**
             * Si no hay sesion activa, se manda a pantalla para confirmar extension
             * Si no se regresa con errores de inicio de sesion
             */
            if ( $v[0]->Error )
            {
                return redirect('agentes/extension')->with('agente', $this->agente);
            }
            else
            {
                return back()->withErrors(['email' => 'El usuario ya tiene sesion activa.']);
            }
        }
        return back()->withErrors(['email' => 'Usuario o Contraseña incorrecta.']);
    }
    /**
     * Funcion de cierre de sesion
     */
    public function agentesLogout( Request $request )
    {

        //$fecha = $this->zona_horaria( auth()->guard('agentes')->id() );
        $fecha = ZonaHorariaController::zona_horaria_agente( auth()->guard('agentes')->id() );

        LogRegistroEventosController::actualiza_evento( $request->input('id_agente'), $request->input('id_evento'), $request->input('cierre') );
        /**
         * Ponemos al usuario en estado 1 = No Disponible
         */
        DB::select("CALL SP_Actualiza_Estado_Agentes(".auth()->guard('agentes')->id().",1,0,'$fecha')");
        /**
         * Ponemos al usuario en pausa dentro de la cola
         */
        $this->pausar_agente( $request->input('id_agente'), 1 );
        /**
         * Se valida que tenga un logueo de extension para colgar
         */
        $canal = Crd_Asignacion_Agente::select('canal')->where( 'Agentes_id', $request->input('id_agente') )->orderBy('id', 'desc')->first();
        $empresa = Agentes::select('Empresas_id')->where( 'id', $request->input('id_agente') )->first();

        if ( !empty( $canal ) )
        {
            //$colgado = EventosAmiController::colgar_llamada( $canal->canal, $empresa->Empresas_id );
        }

        Auth::guard('agentes')->logout();

        return redirect('/agentes/login');
    }
    /**
     * Funcion para mostrar la pantalla de confirmacion de extension
     */
    public function showAgentesExtension( Request $request )
    {
        $agente = auth()->guard('agentes')->user();

        return view('agentes::logeo_extension', compact( 'agente' ) );
    }
    /**
     * Funcion para validar al extension e iniciar sesion
     */
    public function agentesExtension( Request $request )
    {
        /**
         * Obtenemos la modalidad en la cual esta el agente
         */
        $modalidad = $this->modalidad_logueo( $this->agente->id );
        /**
         * Validamos que la extension ingreso sea la misma a la que
         * se tiene guardad en la base de datos
         */
        if( $request->input('extension') == $this->agente->extension )
        {
            /**
             * Validamos que la extension no este disponible
             */
            $disponible = $this->Valida_Extension( $this->agente->extension );

            if ( $disponible->Historial_Eventos->first()->fk_cat_estado_agente_id == 1 || $disponible->Historial_Eventos->first()->fk_cat_estado_agente_id == 11 )
            {
                /**
                 * Ponemos al usuario en pausa dentro de la cola
                 */
                $this->pausar_agente( $this->agente->id, 0 );

                $evento = LogRegistroEventosController::registro_evento( $this->agente->id, 1 );

                return redirect()->action('\Modules\Agentes\Http\Controllers\AgentesController@index', ['evento' => $evento->id]);
            }
            else
            {
                return back()->withErrors(['email' => 'La extension ya se encuentra en uso.']);
            }
        }
        else
        {
            /**
             * Validamos que la extension no este disponible
             */
            $disponible = $this->Valida_Extension( $request->input('extension') );

            if ( $disponible->Historial_Eventos->first()->fk_cat_estado_agente_id == 1 || $disponible->Historial_Eventos->first()->fk_cat_estado_agente_id == 11 )
            {
                $this->Actualiza_Estado_Extension_Agente( $this->agente->id, $modalidad, $request->input('extension') );

                $evento = LogRegistroEventosController::registro_evento( $this->agente->id, 1 );

                return redirect()->action('\Modules\Agentes\Http\Controllers\AgentesController@index', ['evento' => $evento->id]);
            }
            else
            {
                return back()->withErrors(['email' => 'La extension ya se encuentra en uso.']);
            }
        }
    }
    /**
     * Funcion para validar si el Agente/Extension esta disponible
     */
    private function Valida_Extension( $extension)
    {
        return Agentes::where('extension',$extension)->with(['Historial_Eventos' => function ($query)  {
            $query->orderBy('fecha_registro', 'desc')
                    ->first();
        }])->first();
    }
    /**
     * Funcion para actualizar la extension y el estado del agente/extension
     */
    private function Actualiza_Estado_Extension_Agente( $id_agente, $estado, $extension)
    {
        Agentes::where( 'id', $id_agente )->update(['extension' => $extension]);

        //$fecha = $this->zona_horaria( auth()->guard('agentes')->id() );
        $fecha = ZonaHorariaController::zona_horaria_agente( auth()->guard('agentes')->id() );
        DB::select("CALL SP_Actualiza_Estado_Agentes(".$id_agente.",'$estado','NULL','$fecha')");
    }
    /**
     * Funcion para poner el agente en pausa
     */
    private function pausar_agente($id_agente, $estado)
    {
        Miembros_Campana::where( 'membername', $id_agente )->update(['paused' => $estado]);
    }
    /**
     * Se validad la modalidad de logueo
     */
    private function modalidad_logueo($id_agente)
    {
        $modalidad = DB::table('Campanas')
                    ->join( 'Miembros_Campanas', 'Campanas.id', '=', 'Miembros_Campanas.Campanas_id' )
                    ->select(
                                'Campanas.modalidad_logue'
                            )
                    ->where('Campanas.activo', 1)
                    ->where('Miembros_Campanas.membername', $id_agente)
                    ->groupBy('modalidad_logue')
                    ->first();
        /**
         * Si la modalidad es canal abierto, se deja como estado logueado
         * Si la modalidad es canal cerrado, se deja como estado disponible
         */
        if ( isset( $modalidad ) )
        {
            if ( $modalidad->modalidad_logue == 'canal_abierto' )
            {
                return 11;
            }
            else
            {
                return 2 ;
            }
        }
    }
    /*
     * Funcion para setear la hora conforme a la zona horaria de la empresa
     public static function zona_horaria( $id_agente )
     {
         $zona = DB::select("CALL SP_Obten_Zona_Horaria(".$id_agente.")");
         return Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now($zona[0]->zona_horaria))->toDateTimeString();
        }
    */
}
