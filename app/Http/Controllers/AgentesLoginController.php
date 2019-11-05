<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Modules\Agentes\Http\Controllers\LogRegistroEventosController;

use Nimbus\Agentes;

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
        Auth::guard('agentes')->logout();

        LogRegistroEventosController::actualiza_evento( $request->input('id_agente'), $request->input('id_evento') );
        /**
         * Ponemos al usuario en estado 1 = No Disponible
         */
        $this->Actualiza_Estado_Agente( $request->input('id_agente'), 1 );
        /**
         * Ponemos al usuario en pausa dentro de la cola
         */
        $this->pausar_agente( $request->input('id_agente'), 1 );

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

        if( $request->input('extension') == $agente->extension ){

            /**
             * Validamos que la extension no este ya disponible
             */
            $disponible = $this->Valida_Agente( $agente->extension );

            if ( $disponible->isEmpty() ) {

                $this->Actualiza_Estado_Agente( $agente->id, 2 );

                $evento = LogRegistroEventosController::registro_evento( $agente->id, 1 );

                return redirect()->route('post.index', ['evento' => $evento->id]);
                //return redirect()->action('\Modules\Agentes\Http\Controllers\AgentesController@index', ['evento' => $evento->id]);
                //return redirect('/agentes');
            } else {
                return back()->withErrors(['email' => 'La extension ya se encuentra en uso.']);
            }

        } else {

            /**
             * Validamos que la extension no este ya disponible
             */
            $disponible = $this->Valida_Agente( $agente->extension );

            if ( $disponible->isEmpty() ) {

                LogRegistroEventosController::registro_evento( $agente->id, 1 );

                $this->Actualiza_Estado_Extension_Agente( $agente->id, 2, $request->input('extension') );
                return redirect('/agentes');
            } else {
                return back()->withErrors(['email' => 'La extension ya se encuentra en uso.']);
            }
        }
    }
    /**
     * Funcion para validar si el Agente/Extension esta disponible
     */
    public function Valida_Agente( $id_agente)
    {
        return Agentes::where( [['extension',$id_agente],['Cat_Estado_Agente_id','=','2'],])->get();
    }
    /**
     * Funcion para actualizar el estado del agente/extension
     */
    public function Actualiza_Estado_Agente( $id_agente, $estado)
    {
        Agentes::where( 'id', $id_agente )->update(['Cat_Estado_Agente_id' => $estado]);
    }
    /**
     * Funcion para actualizar la extension y el estado del agente/extension
     */
    public function Actualiza_Estado_Extension_Agente( $id_agente, $estado, $extension)
    {
        Agentes::where( 'id', $id_agente )->update(['extension' => $extension,'Cat_Estado_Agente_id' => $estado]);
    }
    /**
     * Funcion para poner el agente en pausa
     */
    public function pausar_agente($id_agente)
    {
        Miembros_Campana::where( 'membername', $id_agente )->update(['Paused' => 0]);
    }
}
