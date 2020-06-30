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
use App\Cat_IP_PBX;
use App\Modulos;
use App\BaseDatos;
use App\Dominios;
use App\Config_Empresas;
use App\Almacenamiento;
use App\Canales;
use App\Cat_Tipo_Canales;
use App\Dids;
use App\Troncales;
use App\Cat_Extensiones;
use App\Token_Soporte;
use App\User;
use App\PrefijosMarcacion;
use Modules\Administrador\Http\Requests\EmpresasRequest;

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
        $empresas = Empresas::active()->with('Config_Empresas.Distribuidores')->get();
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
                $dominio = str_replace(' ', '_', $data['dominio']).".Appcca.mx";
            } else {
                $dominio = str_replace(' ', '_', $data['dominio']).".Appcca.mx";
            }
            /**
             * Guardamos la informacion del nuevo dominio
             */
            $dominios = new Dominios;
            $dominios->dominio = $dominio;
            $dominios->dominio_bria = $dominio;
            $dominios->save();
            /**
             * Generamos la Clave de Aprovisionamiento
             */
            $claveApro = $this->contra(10);
            /**
             * Insertamos la configuracion inicial de la empresa
             */
            $config = new Config_Empresas();
            $config->Empresas_id = $data['id_empresa'];
            $config->Cat_IP_PBX_id = $data['media_server_empresas'];
            $config->Cat_Base_Datos_id = $data['base_datos_empresa'];
            $config->Dominios_id = $dominios->id;
            $config->Cat_distribuidor_id = $data['Cat_Distribuidor_id'];
            $config->clave_aprov = $claveApro;
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

            /**
             * Recuperamos todos los distribuidores que esten activos
             */
            $empresas = Empresas::findOrFail($data['id_empresa']);
            $distribuidor = Cat_Distribuidor::findOrFail( $empresas->Config_Empresas->Cat_Distribuidor_id );
            $troncales = $distribuidor->Troncales;
            $canales = Cat_Tipo_Canales::where('Cat_Distribuidor_id', $empresas->Config_Empresas->Cat_Distribuidor_id)->get();

            return view('administrador::canales.create', compact( 'troncales', 'empresas','distribuidor','canales') );

        } else if($data['action'] == 'dataCanales') {

            $id_Distribuidor = $data['Cat_Distribuidor_id'];
            $prefijo = $data['preDist'].$data['preEmp'];
            $id_Empresa = $data['id_empresa'];
            $id = $data['id_empresa'];

            array_shift( $data );
            array_shift( $data );
            array_shift( $data );
            array_shift( $data );
            array_shift( $data );
            array_shift( $data );

            $info = array_chunk( $data, 5 );

            for($i=0;$i<count($info);$i++){

                if ( $info[$i][1] == 'LOCAL/' ) {
                    $Troncales_id = 1;
                } else {
                    $Troncales_id = $info[$i][2];
                }
                Canales::create([
                        'protocolo'=>$info[$i][1],
                        'prefijo'=>$prefijo.$info[$i][3],
                        'Troncales_id'=>$Troncales_id,
                        'Cat_Distribuidor_id'=>$id_Distribuidor,
                        'Cat_Canales_Tipo_id'=>$info[$i][0],
                        'Empresas_id'=>$id_Empresa
                ]);
            }

            /**
             * Recuperamos los canales que estan asocioados a la empresa
             */
            $canales = Canales::active()->where('Empresas_id', $id_Empresa )->get();

            /**
             * Obtenemos las extensiones que ya tiene la empresa
             */
            $extensiones = Cat_Extensiones::active()->where('Empresas_id', $id_Empresa)->get();
            $extCreadas = $extensiones->count();
            /**
             * Obtenemos las posiciones asignadas para la empresa
             */
            $configEmpresa = Config_Empresas::where('Empresas_id', $id_Empresa )->get();
            $numExtensiones = $configEmpresa[0]->agentes_entrada + $configEmpresa[0]->agentes_salida + $configEmpresa[0]->agentes_dual;


            return view('administrador::cat_extensiones.create', compact('id', 'canales', 'numExtensiones', 'extCreadas', 'extensiones') );

        } else if($data['action'] == 'dataExtensiones') {
            $id = $data['id_empresa'];
             /**
             * Guardamos la informacion del nuevo dominio
             */
            for ($i=0; $i < (int)$data['posiciones']; $i++) {
                $catExtension = new Cat_Extensiones;
                $catExtension->extension = (int)$data['extension'] + $i;
                $catExtension->Empresas_id = $data['id_empresa'];
                $catExtension->Canales_id = $data['canal_id'];
                $catExtension->save();
            }

            /**
             * Obtenemos los canales de la empresa
             */
            $canales = Canales::active()->where('Empresas_id', $id)->get();

            return view('administrador::dids.create', compact( 'canales', 'id'));

        } else if($data['action'] == 'dataDids') {

             /**
             * Obtener los dids que se van a insertar separados por ;
             */
            $dids_store = explode(";", str_replace("\n",";",$data['did'] ));
            /**
             * Se recorre arreglo de dids
             */
            for ($i=0; $i < count($dids_store); $i++) {
                Dids::create([
                                'did'=>trim($dids_store[$i]),
                                'numero_real'=>$data['numero_real'],
                                'referencia'=>$data['referencia'],
                                'gateway'=>$data['gateway'],
                                'fakedid'=>$data['fakedid'],
                                'Canales_id'=> $data['Canal_id'],
                                'Empresas_id'=>$data['id_empresa']
                            ]);
            }

            return redirect()->route('empresas.index');

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
            /***
             * Buscamos los datos del Almacenamiento y Configuracion para la grafica
             */
            $config_empresas = Config_Empresas::where('Empresas_id',$idEmpresa)->get();
            $inbound = Almacenamiento::active()->where('Empresas_id',$idEmpresa)->sum('grabaciones_entrada');
            $outbound = Almacenamiento::active()->where('Empresas_id',$idEmpresa)->sum('grabaciones_salida');
            $manual = Almacenamiento::active()->where('Empresas_id',$idEmpresa)->sum('grabaciones_manuales');
            $buzon = Almacenamiento::active()->where('Empresas_id',$idEmpresa)->sum('buzon_voz');
            $audios = Almacenamiento::active()->where('Empresas_id',$idEmpresa)->sum('audios_empresa');

            return view('administrador::empresas.general', compact('empresa','config_empresas', 'inbound', 'outbound', 'manual', 'buzon', 'audios'));

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
                $dominio = str_replace(' ', '_', $data['dominio']).".Appcca.mx";
            } else {
                $dominio = str_replace(' ', '_', $data['dominio']).".Appcca.mx";
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
            Config_Empresas::where('Empresas_id', $data['id_empresa'] )->update([
                        'almacenamiento_adicional'   =>   $almaAdicional
                    ]);
            /**
             * Regreamos la informacion para mostrar la vista de editar canales
             */
            if ($request->input('accion') == "actualizar") {
                /**
                 * Buscamos la informacion de la empresa
                 */
                $empresas = Empresas::findOrFail($data['id_empresa']);
                /**
                 * Devolvemos la informacion de los canales de la empresa
                 */
                $canales = Canales::active()->where('Empresas_id', $data['id_empresa'] )->get();
                /**
                 * Recuperamos los tipo de canales en base al distribuidor que esta dado de alta la empresa
                 */
                $TipoCanales = Cat_Tipo_Canales::active()->where('Cat_Distribuidor_id', $empresas->Config_Empresas->Cat_Distribuidor_id)->get();
                /**
                 * Recuperamos las troncales asociadas a la empresa
                 */
                $troncales = Troncales::where([
                                                ['activo', '=', '1'],
                                                ['Cat_Distribuidor_id', '=',  $empresas->Config_Empresas->Cat_Distribuidor_id]
                                            ])->get();

                $idEmpresa = $data['id_empresa'];

                return view('administrador::canales.show', compact('canales', 'idEmpresa', 'TipoCanales', 'troncales') );
            }

        } else if( $data['action'] == 'dataCanales' ) {
            $id = $data['id_empresa'];

            array_shift( $data );
            array_shift( $data );
            array_shift( $data );

            $info = array_chunk( $data, 6 );

            for($i=0;$i<count($info);$i++){
                /**
                 * Actualizamos el canal
                 */
                if ( $info[$i][2] == 'LOCAL/' ) {
                    $Troncales_id = 1;
                } else {
                    $Troncales_id = $info[$i][3];
                }
                Canales::where([
                                    ['Empresas_id', '=', $id],
                                    ['id', '=', $info[$i][0]],
                                ])->update([
                                    'protocolo' => $info[$i][2],
                                    'prefijo' => $info[$i][5].$info[$i][4],
                                    'Troncales_id' => $Troncales_id,
                                    'Cat_Canales_Tipo_id' => $info[$i][1],
                                ]);
            }

            /**
             * Regreamos la informacion para mostrar la vista de editar canales
             */
            if ($request->input('accion') == "actualizar") {
                /**
                 * Recuperamos los canales que estan asocioados a la empresa
                 */
                $canales = Canales::active()->where('Empresas_id', $id )->get();

                /**
                 * Obtenemos las extensiones que ya tiene la empresa
                 */
                $extensiones = Cat_Extensiones::active()->where('Empresas_id', $id)->get();
                $extCreadas = $extensiones->count();
                /**
                 * Obtenemos las posiciones asignadas para la empresa
                 */
                $configEmpresa = Config_Empresas::where('Empresas_id', $id )->get();
                $numExtensiones = $configEmpresa[0]->agentes_entrada + $configEmpresa[0]->agentes_salida + $configEmpresa[0]->agentes_dual;

                return view('administrador::cat_extensiones.create', compact('id', 'canales', 'numExtensiones', 'extCreadas', 'extensiones') );

            }

        } else if( $data['action'] == 'dataExtensiones' ) {
            $id = $data['id_empresa'];

            array_shift( $data );
            array_shift( $data );
            array_shift( $data );

            $info = array_chunk( $data, 3 );

            for($i=0;$i<count($info);$i++){
                /**
                 * Actualizamos la extension
                 */
                Cat_Extensiones::where( [
                                            ['id', '=',  $info[$i][0] ],
                                            ['Empresas_id', '=', $id]
                                        ])->update([
                                            'extension' => $info[$i][2],
                                            'Canales_id' =>  $info[$i][1]
                                        ]);
            }

            if ($request->input('accion') == "actualizar") {
                 /**
                 * Obtenemos los canales de la empresa
                 */
                $canales = Canales::active()->where('Empresas_id', $id)->get();

                return view('administrador::dids.create', compact( 'canales', 'id'));
            }

        } else if( $data['action'] == 'dataPrefijos' ) {
            $id = $data['id_empresa'];
            dd($id);

        }
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Empresas::where( 'id', $id )
        ->update([
            'activo' => 0
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('empresas.index');
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
