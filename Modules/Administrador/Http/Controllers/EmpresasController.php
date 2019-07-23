<?php

namespace Modules\Administrador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nimbus\Empresas;
use Nimbus\Cat_Distribuidor;
use Nimbus\Cat_IP_PBX;
use Nimbus\Modulos;
use Nimbus\BaseDatos;
use Nimbus\Dominios;
use Nimbus\Config_Empresas;
use Nimbus\Canales;
use Nimbus\Cat_Tipo_Canales;
use Nimbus\Troncales;
use Nimbus\Cat_Extensiones;

class EmpresasController extends Controller
{
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
        $dataModulos = array();
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
            if ( $dataForm[$i]['name'] == 'modulos[]' ) {
                array_push( $dataModulos, $dataForm[$i]['value'] );
            }
        }

        $idEmpresa = $data['id_empresa'];
        if( $data['action'] == 'dataEmpresa' ){
            /**
             * Insertamos la informacion del formulario.
             * Creamos un nuevo objeto de Empresas, para poder
             * acceder a sus atributos y crear una nueva empresa.
             */
            $empresa = new Empresas;
            /**
             * Asignamos los nuevos valores
             */
            $empresa->nombre = $data['nombre'];
            $empresa->contacto_cliente = $data['contacto_cliente'];
            $empresa->direccion = $data['direccion'];
            $empresa->ciudad = $data['ciudad'];
            $empresa->estado = $data['estado'];
            $empresa->pais = $data['pais'];
            $empresa->telefono = $data['telefono'];
            $empresa->movil = $data['movil'];
            $empresa->correo = $data['correo'];
            /**
             * Guardamos la nueva informacion
             */
            $empresa->save();

            $Cat_Distribuidor_id = $data['distribuidores_empresa'];
            $origen = "createEmpresa";
            /**
             * Recuperamos todos los MS que esten activos
             */
            $medias = Cat_IP_PBX::where('activo',1)->get();
            /**
             * Recuperamos todos las BD que esten activos
             */
            $baseDatos = BaseDatos::where('activo',1)->get();

            return view('administrador::empresas.infra', compact('empresa', 'medias', 'baseDatos', 'Cat_Distribuidor_id', 'origen') );

        } else if($data['action'] == 'dataInfra') {
            /**
             * Creamos el nuevo dominio
             */
            if ($request->input('Cat_Distribuidor_id') == 11) {
                $dominio = str_replace(' ', '_', $data['dominio']).".nimbuscca.mx";
            } else {
                $dominio = str_replace(' ', '_', $data['dominio']).".nimbuscca.mx";
            }
            /**
             * Guardamos la informacion del nuevo dominio
             */
            $dominios = new Dominios;
            $dominios->dominio = $dominio;
            $dominios->dominio_bria = $dominio;
            $dominios->save();
            /**
             * Insertamos la configuracion inicial de la empresa
             */
            $config = new Config_Empresas();
            $config->Empresas_id = $data['id_empresa'];
            $config->Cat_IP_PBX_id = $data['media_server_empresas'];
            $config->Cat_Base_Datos_id = $data['base_datos_empresa'];
            $config->Dominios_id = $dominios->id;
            $config->Cat_distribuidor_id = $data['Cat_Distribuidor_id'];
            $config->save();
            /**
             * Recuperamos todos los modulos que esten activos
             */
            $modulos = Modulos::where('activo',1)->get();
            /**
             * Reciclamos variables
             */
            $idEmpresa = $data['id_empresa'];

            return view('administrador::empresas.modulos', compact('idEmpresa', 'modulos') );

        } else if($data['action'] == 'dataModulo') {
             /**
             * Buscamos la empresa
             */
            $empresa = Empresas::findOrFail($idEmpresa);
            /**
             * Desvinculamos todos los modulos a la empresa
             */
            $empresa->modulos()->detach();
            /**
             * Vinculamos los modulos seleccionados a la empresa
             */
            $empresa->modulos()->attach( $dataModulos );

            /**
             * Obtenemos los modulos de la empresa
             */
            $modulos = $empresa->Modulos->pluck('id')->toArray();
            /**
             * Devolvemos la informacion de la infraestructura de la empresa
             */
            $configEmpresa = Config_Empresas::findOrFail( $idEmpresa );

            return view('administrador::empresas.posiciones', compact('modulos', 'configEmpresa', 'idEmpresa') );

        } else if($data['action'] == 'dataPosiciones') {
           /**
             * Calculamos el espacion de almacenamiento en base
             * a las posiciones
             */
            $almaPosiciones = ( $data['agentes_entrada'] + $data['agentes_salida'] + $data['agentes_full'] ) * 2048;
            /**
             * Buscamos la empresa ha editar
             */
            Config_Empresas::where('Empresas_id', $data['id_empresa'] )->update([
                'agentes_entrada' => $data['agentes_entrada'],
                'agentes_salida'   => $data['agentes_salida'],
                'agentes_dual' => $data['agentes_full'],
                'canal_mensajes_voz'   =>$data['canal_mensajes_voz'],
                'canal_generardor_encuestas'   => $data['canal_generador_encuestas'],
                'licencias_administrador'   => $data['agentes_administrador'],
                'licencias_ivr_inteligente'   => $data['licencias_ivr_inteligente'],
                'licencias_softphone'   =>  $data['licencias_softphone'],
                'almacenamiento_posiciones'   =>  $almaPosiciones
            ]);

            /**
             * Devolvemos la informacion de la infraestructura de la empresa
             */
            $configEmpresa = Config_Empresas::findOrFail( $data['id_empresa'] );

            return view('administrador::empresas.almacenamiento', compact('configEmpresa', 'idEmpresa') );

        } else if($data['action'] == 'dataAlmacenamiento') {
            /**
             * Obtenemos el almacenamiento en MB
             */
            $almaAdicional = str_replace( ' GB', '', ( $data['almacenamiento_adicional'] ));
            $almaAdicional = (int)$almaAdicional * 1024;
            /**
             * Buscamos la empresa ha editar
             */
            Config_Empresas::where('Empresas_id', $data['id_empresa'] )->update([
                'almacenamiento_adicional'   =>   $almaAdicional
            ]);

        }
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data = explode(".", $id);
        $idEmpresa = $data[0];

        if( $data[1] == 'dataGeneral' ) {
            /**
             * Buscamos la empresa ha editar
             */
            $empresa = Empresas::findOrFail($id);

            return view('administrador::empresas.general', compact('empresa'));

        } else if( $data[1] == 'dataEmpresa' ) {
            /**
             * Recuperamos todos los distribuidores que esten activos
             */
            $distribuidores = Cat_Distribuidor::where('activo',1)->get();
            /**
             * Buscamos la empresa ha editar
             */
            $empresa = Empresas::find($id);

            return view('administrador::empresas.empresa', compact('empresa', 'distribuidores'));

        } else if( $data[1] == 'dataInfra' ) {
            /**
             * Devolvemos la informacion de la infraestructura de la empresa
             */
            $configEmpresa = Config_Empresas::find(  $idEmpresa );
            $origen = "showEmpresa";
            /**
             * Recuperamos todos los MS que esten activos
             */
            $medias = Cat_IP_PBX::where('activo',1)->get();
            /**
             * Recuperamos todos las BD que esten activos
             */
            $baseDatos = BaseDatos::where('activo',1)->get();
            /**
             * Obtenemos la informacion de la empresa
             */
            $empresa = $configEmpresa->Empresas;
            $Cat_Distribuidor_id = $configEmpresa->Cat_Distribuidor_id;

            return view('administrador::empresas.infra', compact('empresa', 'medias', 'baseDatos', 'Cat_Distribuidor_id', 'origen') );

        } else if( $data[1] == 'dataModulo' ) {
            /**
             * Buscamos la empresa ha editar
             */
            $empresa = Empresas::find( $idEmpresa );
            /**
             * Recuperamos todos los modulos que esten activos
             */
            $modulos = Modulos::where('activo',1)->get();
            $modulosEmpresa = $empresa->Modulos->pluck('id')->toArray();

            return view('administrador::empresas.modulos', compact( 'modulos', 'modulosEmpresa', 'idEmpresa') );

        } else if( $data[1] == 'dataPosiciones' ) {
            /**
             * Devolvemos la informacion de la infraestructura de la empresa
             */
            $configEmpresa = Config_Empresas::findOrFail( $idEmpresa );
            /**
             * Buscamos la empresa ha editar
             */
            $empresa = Empresas::findOrFail( $idEmpresa );
            /**
             * Obtenemos los modulos de la empresa
             */
            $modulos = $empresa->Modulos->pluck('id')->toArray();

            return view('administrador::empresas.posiciones', compact('modulos', 'configEmpresa', 'idEmpresa') );

        } else if( $data[1] == 'dataAlmacenamiento' ) {
            /**
             * Devolvemos la informacion de la infraestructura de la empresa
             */
            $configEmpresa = Config_Empresas::findOrFail( $data[0] );

            return view('administrador::empresas.almacenamiento', compact('configEmpresa', 'idEmpresa') );

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('administrador::empresas.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $dataModulos = array();
        $dataForm = $request->input('dataForm');

        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
            if ( $dataForm[$i]['name'] == 'modulos[]' ) {
                array_push( $dataModulos, $dataForm[$i]['value'] );
            }
        }
        /**
         *
         */
        if ($data['action'] == "dataEmpresa") {
            /**
             * Buscamos la empresa a editar
             */
            $empresa = Empresas::findOrFail($id);
            /**
             * Asignamos los nuevos valores
             */
            $empresa->nombre = $data['nombre'];
            $empresa->contacto_cliente = $data['contacto_cliente'];
            $empresa->direccion = $data['direccion'];
            $empresa->ciudad = $data['ciudad'];
            $empresa->estado = $data['estado'];
            $empresa->pais = $data['pais'];
            $empresa->telefono = $data['telefono'];
            $empresa->movil = $data['movil'];
            $empresa->correo = $data['correo'];
            /**
             * Guardamos la nueva informacion
             */
            $empresa->save();
            /**
             * Si la accion es actualiar enviamos el formulario para crear
             * una nueva opcion de la empresa
             */
            if ($request->input('accion') == "actualizar") {
                $Cat_Distribuidor_id = $data['distribuidores_empresa'];
                $origen = "createEmpresa";
                /**
                 * Recuperamos todos los MS que esten activos
                 */
                $medias = Cat_IP_PBX::where('activo',1)->get();
                /**
                 * Recuperamos todos las BD que esten activos
                 */
                $baseDatos = BaseDatos::where('activo',1)->get();

                return view('administrador::empresas.infra', compact('empresa', 'medias', 'baseDatos', 'Cat_Distribuidor_id', 'origen') );
            }

        } else if($data['action'] == 'dataInfra') {
            /**
             * Buscamos la configuracion de la empresa
             */
            $config = Config_Empresas::where('Empresas_id', $data['id_empresa'] )->get();
            foreach ($config as $key) {
                $id_dominio = $key->Dominios_id;
            }
            /**
             * Creamos el nuevo dominio
             */
            if ($data['Cat_Distribuidor_id'] == 11) {
                $dominio = str_replace(' ', '_', $data['dominio']).".nimbuscca.mx";
            } else {
                $dominio = str_replace(' ', '_', $data['dominio']).".nimbuscca.mx";
            }
            /**
             * Actualizamos la informacion del dominio
             */
            Dominios::where('id', $id_dominio )->update([
                'dominio' => $dominio,
                'dominio_bria' => $dominio
            ]);
            /**
             * Actualizamos la configuracion inicial de la empresa
             */
            Config_Empresas::where('Empresas_id', $data['id_empresa'] )->update([
                'Empresas_id' => $data['id_empresa'],
                'Cat_IP_PBX_id' => $data['media_server_empresas'],
                'Cat_Base_Datos_id' => $data['base_datos_empresa'],
                'Cat_distribuidor_id' => $data['Cat_Distribuidor_id'],
            ]);

            if ($request->input('accion') == "actualizar") {
                 /**
                 * Buscamos la empresa ha editar
                 */
                $empresa = Empresas::find( $data['id_empresa'] );
                /**
                 * Recuperamos todos los modulos que esten activos
                 */
                $modulos = Modulos::where('activo',1)->get();
                $modulosEmpresa = $empresa->Modulos->pluck('id')->toArray();

                $idEmpresa = $data['id_empresa'];

                return view('administrador::empresas.modulos', compact( 'modulos', 'modulosEmpresa', 'idEmpresa') );
            }

        } else if($data['action'] == 'dataModulo') {
            /**
             * Buscamos la empresa
             */
            $empresa = Empresas::findOrFail($data['id_empresa']);
            /**
             * Desvinculamos todos los modulos a la empresa
             */
            $empresa->modulos()->detach();
            /**
             * Vinculamos los modulos seleccionados a la empresa
             */
            $empresa->modulos()->attach( $dataModulos );

            if ($request->input('accion') == "actualizar") {
                /**
                 * Devolvemos la informacion de la infraestructura de la empresa
                 */
                $configEmpresa = Config_Empresas::findOrFail( $data['id_empresa'] );
                /**
                 * Buscamos la empresa ha editar
                 */
                $empresa = Empresas::findOrFail( $data['id_empresa'] );
                /**
                 * Obtenemos los modulos de la empresa
                 */
                $modulos = $empresa->Modulos->pluck('id')->toArray();

                $idEmpresa = $data['id_empresa'];

                return view('administrador::empresas.posiciones', compact('modulos', 'configEmpresa', 'idEmpresa') );
            }

        } else if( $data['action'] == 'dataPosiciones' ) {
            /**
             * Calculamos el espacion de almacenamiento en base
             * a las posiciones
             */
            $almaPosiciones = ( $data['agentes_entrada'] + $data['agentes_salida'] + $data['agentes_full'] ) * 2048;
            /**
             * Buscamos la empresa ha editar
             */
            Config_Empresas::where('Empresas_id', $data['id_empresa'] )->update([
                'agentes_entrada' => $data['agentes_entrada'],
                'agentes_salida'   => $data['agentes_salida'],
                'agentes_dual' => $data['agentes_full'],
                'canal_mensajes_voz'   =>$data['canal_mensajes_voz'],
                'canal_generardor_encuestas'   => $data['canal_generador_encuestas'],
                'licencias_administrador'   => $data['agentes_administrador'],
                'licencias_ivr_inteligente'   => $data['licencias_ivr_inteligente'],
                'licencias_softphone'   =>  $data['licencias_softphone'],
                'almacenamiento_posiciones'   =>  $almaPosiciones
            ]);

            if ($request->input('accion') == "actualizar") {
                /**
                 * Devolvemos la informacion de la infraestructura de la empresa
                 */
                $configEmpresa = Config_Empresas::findOrFail( $data['id_empresa'] );

                $idEmpresa = $data['id_empresa'];

                return view('administrador::empresas.almacenamiento', compact('configEmpresa', 'idEmpresa') );
            }

        } else if( $data['action'] == 'dataAlmacenamiento' ) {
            /**
             * Obtenemos el almacenamiento en MB
             */
            $almaAdicional = str_replace( ' GB', '', ( $data['almacenamiento_adicional'] ));
            $almaAdicional = (int)$almaAdicional * 1024;
            /**
             * Buscamos la empresa ha editar
             */
            Config_Empresas::where('Empresas_id', $data['idEmpresa'] )->update([
                'almacenamiento_adicional'   =>   $almaAdicional
            ]);
            if ($request->input('accion') == "actualizar") {
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
