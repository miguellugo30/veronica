<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

/**
 * Modelos a usar
 */
use App\Empresas;
use App\Dominios;
use App\Config_Empresas;
use App\Canales;
use App\Cat_Extensiones;
use App\Dids;

class SaveWizardEmpresasController extends Controller
{
    public function __construct()
    {}

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store($data)
    {
        /**
         * Guardamos la empresa
         */
        $empresa = Empresas::create([
            'nombre' => $data['empresa']['nombre'],
            'contacto_cliente' => $data['empresa']['contacto_cliente'],
            'direccion' => $data['empresa']['direccion'],
            'ciudad' => $data['empresa']['ciudad'],
            'estado' => $data['empresa']['estado'],
            'pais' => $data['empresa']['pais'],
            'telefono' => $data['empresa']['telefono'],
            'movil' => $data['empresa']['movil'],
            'correo' => $data['empresa']['correo']
        ]);
        /**
         * Guardamos el dominio
         */
        $dominio = Dominios::create([
            'dominio' => $data['infraestructura']['dominio'],
            'dominio_bria' => $data['infraestructura']['dominio']
        ]);
        /**
         * Generamos la Clave de Aprovisionamiento
         */
        $claveApro = $this->contra(10);
        /**
         * Guardamos la configuracion de la empresa
         */
        Config_Empresas::create([
            'Empresas_id' => $empresa->id,
            //Alta de información de Infraestructura
            'Cat_IP_PBX_id' => $data['infraestructura']['media_server_empresas'],
            'Cat_Base_Datos_id' => $data['infraestructura']['base_datos_empresa'],
            'Dominios_id' => $dominio->id,
            'Cat_Distribuidor_id' => '1',
            'clave_aprov' => $claveApro,
            //Alta de información de Posiciones
            'agentes_entrada' => $data['posiciones']['agentes_entrada'],
            'agentes_salida' => $data['posiciones']['agentes_salida'],
            'agentes_dual' => $data['posiciones']['agentes_full'],
            'licencias_administrador' => $data['posiciones']['agentes_administrador'],
            'licencias_softphone' => $data['posiciones']['licencias_softphone'],
            //Alta de información de Almacenamiento
            'almacenamiento_posiciones' => ( $data['almacenamiento']['almacenamiento_posiciones'] * 1024 ),
            'almacenamiento_adicional' => ( $data['almacenamiento']['almacenamiento_adicional'] * 1024 )
        ]);
        /**
         * Desvinculamos todos los modulos a la empresa
         */
        $empresa->modulos()->detach();
        /**
         * Vinculamos los modulos seleccionados a la empresa
         */
        foreach ($data['modulo'] as $key => $value)
        {
            $empresa->modulos()->attach( $value );
        }
        /**
         * Guardamos los canales
         */
        $dataCanales = array_chunk($data['canales'], 5 );
        $idCanales = array();

        for ($i=0; $i < count($dataCanales); $i++)
        {
            $canal = Canales::create([
                'protocolo' => $dataCanales[$i][1],
                'prefijo' => $empresa->id.$dataCanales[$i][3],
                'Troncales_id' => $dataCanales[$i][2],
                'Cat_Distribuidor_id' => 1,
                'Cat_Canales_Tipo_id' => $dataCanales[$i][0],
                'Empresas_id' => $empresa->id
            ]);
            array_push($idCanales, $canal->id);
        }
        /**
         * Guardamos las extensiones
         */
        for ($i=0; $i < $data['extensiones']['posiciones']; $i++)
        {
            Cat_Extensiones::create([
                'extension' => $data['extensiones']['extension'].$i,
                'Empresas_id' => $empresa->id,
                'Canales_id' =>  $idCanales[ $data['extensiones']['canal_id'] ]
            ]);
        }
        /**
         * Guardamos los DIDs
         */
        $dids = explode( PHP_EOL, $data['dids']['did'] );

        for ($i=0; $i < count($dids); $i++)
        {
            Dids::create([
                'did' => (string)$dids[$i],
                'numero_real' => $data['dids']['numero_real'],
                'referencia' => $data['dids']['referencia'],
                'gateway' => $data['dids']['gateway'],
                'fakedid' => $data['dids']['fakedid'],
                'Canales_id' => $idCanales[ $data['extensiones']['canal_id'] ],
                'Empresas_id' => $empresa->id
                ]);
        }
    }
    /**
     * Función para generar una contraseña, el tamaño se
     * define en el parámetro que se le pasa ( Largo )
     */
    public function contra($largo){
        $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $cadena_base .= '0123456789';
        $cadena_base .= '!@#%&*()_/<>?=+';

        $password = '';
        $limite = strlen($cadena_base) - 1;

        for ($i=0; $i < $largo; $i++){
            $password .= $cadena_base[rand(0, $limite)];
        }

        return $password;
    }

}
