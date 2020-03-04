<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;
use Modules\Agentes\Http\Controllers\EventosAmiController;
use DB;

use Nimbus\Agentes;
use Nimbus\Miembros_Campana;
use Nimbus\Crd_Asignacion_Agente;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAgentesLoginForm()
    {
        return view('vendor.adminlte.login_agente', ['url' => 'agentes'] );
    }

    public function agentesLogin(Request $request)
    {
        if (auth()->guard('agentes')->attempt(['email' => $request->email, 'password' => $request->password])) {

            /**
             * Validamos que el usuario no este ya logueado
             */
            $logueado = $this->Valida_Agente( auth()->guard('agentes')->id() );

            if ( $logueado->isEmpty() ) {
                /**
                 * Ponemos al usuario en estado 11 = Logueado
                 */
                $this->Actualiza_Estado_Agente( auth()->guard('agentes')->id(), 11 );

                $agente = auth()->guard('agentes')->user();
                return redirect('agentes/extension')->with('agente', $agente);
            } else {
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
        LogRegistroEventosController::actualiza_evento( $request->input('id_agente'), $request->input('id_evento'), $request->input('cierre') );
        /**
         * Ponemos al usuario en estado 1 = No Disponible
         */
        $this->Actualiza_Estado_Agente( $request->input('id_agente'), 1 );
        /**
         * Ponemos al usuario en pausa dentro de la cola
         */
        $this->pausar_agente( $request->input('id_agente'), 1 );
        /**
         * Se valida que tenga un logueo de extension para colgar
         */
        $canal = Crd_Asignacion_Agente::select('canal')->where( 'Agentes_id', $request->input('id_agente') )->orderBy('id', 'desc')->first();
        $empresa = Agentes::select('Empresas_id')->where( 'id', $request->input('id_agente') )->first();

        if ( !empty( $canal ) ) {
            $colgado = EventosAmiController::colgar_llamada( $canal->canal, $empresa->Empresas_id );
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
        $agente = auth()->guard('agentes')->user();

        /**
         * Obtenemos la modalidad en la cual esta el agente
         */
        $modalidad = $this->modalidad_logueo( $agente->id );

        /**
         * Validamos que la extension ingreso sea la misma a la que
         * se tiene guardad en la base de datos
         */
        if( $request->input('extension') == $agente->extension )
        {
            /**
             * Validamos que la extension no este disponible
             */
            $disponible = $this->Valida_Agente( $agente->extension );

            if ( $disponible->isEmpty() )
            {
                $this->Actualiza_Estado_Agente( $agente->id, 11 );
                /**
                 * Ponemos al usuario en pausa dentro de la cola
                 */
                $this->pausar_agente( $agente->id, 0 );

                $evento = LogRegistroEventosController::registro_evento( $agente->id, 1 );

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
            $disponible = $this->Valida_Agente( $request->input('extension') );

            if ( $disponible->isEmpty() )
            {
                $this->Actualiza_Estado_Extension_Agente( $agente->id, $modalidad, $request->input('extension') );

                $evento = LogRegistroEventosController::registro_evento( $agente->id, 1 );

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
    private function Valida_Agente( $id_agente)
    {
        return Agentes::where('id',$id_agente)->whereIn('Cat_Estado_Agente_id',[2,3,4,8])->get();
    }
    /**
     * Funcion para actualizar el estado del agente/extension
     */
    private function Actualiza_Estado_Agente( $id_agente, $estado)
    {
        Agentes::where( 'id', $id_agente )->update(['Cat_Estado_Agente_id' => $estado]);
    }
    /**
     * Funcion para actualizar la extension y el estado del agente/extension
     */
    private function Actualiza_Estado_Extension_Agente( $id_agente, $estado, $extension)
    {
        Agentes::where( 'id', $id_agente )->update(['extension' => $extension,'Cat_Estado_Agente_id' => $estado]);
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
}
