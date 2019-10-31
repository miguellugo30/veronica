<?php

namespace Nimbus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
            $logueado = Agentes::where( [['id', auth()->guard('agentes')->id()],['Cat_Estado_Agente_id','=','2'],])->get();

            if ( $logueado->isEmpty() ) {
                /**
                 * Ponemos al usuario en estado 11 = Logueado
                 */
                Agentes::where( 'id', auth()->guard('agentes')->id() )->update(['Cat_Estado_Agente_id' => 11]);

                $agente = auth()->guard('agentes')->user();
                return redirect('agentes/extension')->with('agente', $agente);
            } else {
                return back()->withErrors(['email' => 'El usuario ya tiene sesion activa.']);
            }
        }
        return back()->withErrors(['email' => 'Usuario o Contraseña incorrecta.']);
    }

    public function agentesLogout( Request $request )
    {

        Auth::guard('agentes')->logout();
        /**
         * Ponemos al usuario en estado 1 = No Disponible
         */
        Agentes::where( 'id', $request->input('id_agente') )->update(['Cat_Estado_Agente_id' => 1]);

        return redirect('/agentes/login');
    }

    public function showAgentesExtension( Request $request )
    {

        $agente = auth()->guard('agentes')->user();

        return view('agentes::logeo_extension', compact( 'agente' ) );
    }

    public function agentesExtension( Request $request )
    {

        $agente = auth()->guard('agentes')->user();

        if( $request->input('extension') == $agente->extension ){

            /**
             * Validamos que la extension no este ya disponible
             */
            $disponible = Agentes::where( [['extension', $agente->extension],['Cat_Estado_Agente_id','=','2'],])->get();

            if ( $disponible->isEmpty() ) {

                Agentes::where( 'id', $agente->id )->update(['Cat_Estado_Agente_id' => 2]);
                return redirect('/agentes');
            } else {
                return back()->withErrors(['email' => 'La extension ya se encuentra en uso.']);
            }

        } else {

            /**
             * Validamos que la extension no este ya disponible
             */
            $disponible = Agentes::where( [['id', $request->input('extension')],['Cat_Estado_Agente_id','=','2'],])->get();

            if ( $disponible->isEmpty() ) {
                Agentes::where( 'id', $agente->id )->update(['extension' => $request->input('extension'),'Cat_Estado_Agente_id' => 2]);
                return redirect('/agentes');
            } else {
                return back()->withErrors(['email' => 'La extension ya se encuentra en uso.']);
            }
        }
    }
}
