<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
/**
 * Modelos a usar
 */
use App\Cat_IP_PBX;
use App\Empresas;
use App\BaseDatos;
use App\Modulos;
use App\Config_Empresas;
use App\Cat_Distribuidor;
use App\Cat_Tipo_Canales;


class WizardEmpresaController extends Controller
{
    public $steps;
    public $empresa;
    public $Cat_IP_PBX;
    public $BaseDatos;
    public $Modulos;
    public $Config_Empresas;
    public $Cat_Distribuidor;
    public $Cat_Tipo_Canales;

    public function __construct(
                        Cat_IP_PBX $Cat_IP_PBX,
                        BaseDatos $BaseDatos,
                        Modulos $Modulos,
                        Config_Empresas $Config_Empresas,
                        Cat_Distribuidor $Cat_Distribuidor,
                        Cat_Tipo_Canales $Cat_Tipo_Canales,
                        Empresas $empresa
    )
    {
        $this->steps = ['empresa', 'infraestructura', 'modulo', 'posiciones', 'almacenamiento', 'canales', 'extensiones', 'dids'];

        $this->empresa = $empresa;
        $this->Cat_IP_PBX = $Cat_IP_PBX;
        $this->BaseDatos = $BaseDatos;
        $this->Modulos = $Modulos;
        $this->Config_Empresas = $Config_Empresas;
        $this->Cat_Distribuidor = $Cat_Distribuidor;
        $this->Cat_Tipo_Canales = $Cat_Tipo_Canales;
    }

    /**
     * Función para mostrar la vista inicial
     */
    public function wizard( $step = null, Request $request )
    {
        /**
         * Eliminamos todo dato que se pudiera quedar en la session
         */
        $request->session()->forget( $this->steps );
        /**
         * Validamos que existe un paso, si no se setear el primer paso
         */
        if ( is_null( $step ) ) {
            $step = $this->steps[0];
        }
        /**
         * Recuperamos el indice del paso
         */
        $indice = $this->index( $step );
        /**
         * Recuperamos la información necesaria para dar del alta
         * en el paso en turno
         */
        $data = $this->dataStep( $step );

        $stepsAc = collect([ 'prev' => $this->prevStep( $indice ), 'current' => $step, 'next' => $this->nextStep( $indice ) ]);
        $steps = $this->steps;
        $stepNumber = $indice++;

        return view('administrador::wizardEmpresa.index', compact( 'stepsAc', 'steps', 'indice', 'data' ));
    }
    /**
     * Función para almacenar y mostrar el siguiente paso
     */
    public function wizardPost( Request $request, $step )
    {
        /**
         * Recuperamos el indice del paso
         */
        $indice = $this->index( $step );
        /**
         * Procesamos la información del formulario
         */
        if ( isset( $request->dataForm ) )
        {
            $this->processData( $request, $this->prevStep( $indice ) );
        }
        /**
         * Recuperamos la información necesaria para dar del alta
         * en el paso en turno
         */
        $data = $this->dataStep( $step );

        $stepsAc = collect([ 'prev' => $this->prevStep( $indice ), 'current' => $step, 'next' => $this->nextStep( $indice ) ]);
        $steps = $this->steps;
        $stepNumber = $indice++;

        return view('administrador::wizardEmpresa.index', compact( 'stepsAc', 'steps', 'indice', 'data' ));
    }
    /**
     * Función para obtener el siguiente elemento
     */
    private function nextStep( $indice )
    {
        if ( $indice++ >= ( count($this->steps) - 1 ) )
        {
            return 'end';
        }
        return $this->steps[$indice++];
    }
    /**
     * Función para obtener el anterior elemento
     */
    private function prevStep( $indice )
    {
        if ( $indice-- <= 0 )
        {
            return 'start';
        }
        return $this->steps[$indice--];
    }
    /**
     * Función para obtener el indice del elemento actual
     */
    private function index( $step )
    {
        for ($i=0; $i < count( $this->steps ); $i++)
        {
            if ( $step === $this->steps[$i]  )
            {
                return $i;
            }
        }
    }
    /**
     * Función para mostrar la información necesaria, para el paso
     * en turno
     */
    public function dataStep( $step )
    {

        $data = array();

        if ( $step == 'empresa' )
        {
            /**
             * Recuperamos todos los distribuidores que esten activos
             */
            $data[ 'Cat_Distribuidor' ] = $this->Cat_Distribuidor->active()->get();

        }
        elseif( $step == 'infraestructura' )
        {
            /**
             * Recuperamos todos los MS que esten activos
             */
            $data[ 'medias' ] = $this->Cat_IP_PBX->active()->get();
            /**
             * Recuperamos todos las BD que esten activos
             */
            $data[ 'baseDatos' ] = $this->BaseDatos->active()->get();
        }
        elseif( $step == 'modulo' )
        {
            /**
             * Recuperamos todos los modulos que esten activos
             */
            $data[ 'modulos' ] = $this->Modulos->active()->get();
        }
        elseif( $step == 'posiciones' )
        {

        }
        elseif( $step == 'almacenamiento' )
        {

        }
        elseif( $step == 'canales' )
        {
            $dataEmpresa = session( 'empresa' );

            $distribuidor = $this->Cat_Distribuidor->findOrFail( $dataEmpresa['distribuidores_empresa'] );
            $data[ 'troncales' ] = $distribuidor->Troncales;
            $data[ 'canales' ] = $this->Cat_Tipo_Canales->where('Cat_Distribuidor_id', $dataEmpresa['distribuidores_empresa'] )->get();
        }
        elseif( $step == 'extensiones' )
        {
        }
        elseif( $step == 'dids' )
        {
            # code...
        }

        return $data;

    }
    /**
     * Función para procesar la información enviada desde los
     * formularios
     */
    public function processData( $request, $step )
    {
        $data = array();
        $dataForm = $request->dataForm;

        for ($i=0; $i < count( $dataForm ); $i++)
        {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }

        session([$step => $data]);
    }
}
