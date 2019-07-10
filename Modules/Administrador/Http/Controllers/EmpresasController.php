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
        $empresas = Empresas::where('activo',1)->get();
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

        /**
         * Recuperamos todos los MS que esten activos
         */
        //$medias = Cat_IP_PBX::where('activo',1)->get();

        return view('administrador::empresas.create', compact('distribuidores') );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if( $request->input('action') == 'dataEmpresa' ){
            /**
             * Insertamos la informacion del formulario
             */
            $empresa = Empresas::create($request->all());
            $Cat_Distribuidor_id = $request->input('Cat_Distribuidor_id');

            /**
             * Recuperamos todos los MS que esten activos
             */
            $medias = Cat_IP_PBX::where('activo',1)->get();
            /**
             * Recuperamos todos las BD que esten activos
             */
            $baseDatos = BaseDatos::where('activo',1)->get();

            return view('administrador::empresas.infra', compact('empresa', 'medias', 'baseDatos', 'Cat_Distribuidor_id') );

        } else if($request->input('action') == 'dataInfra') {
            /**
             * Creamos el nuevo dominio
             */
            if ($request->input('Cat_Distribuidor_id') == 11) {
                $dominio = str_replace(' ', '_', $request->input('dominio')).".nimbuscca.mx";
            } else {
                $dominio = str_replace(' ', '_', $request->input('dominio')).".nimbuscca.mx";
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
            $config->Empresas_id = $request->input('id_empresa');
            $config->Cat_IP_PBX_id = $request->input('media_server_empresas');
            $config->Cat_Base_Datos_id = $request->input('base_datos_empresa');
            $config->Dominios_id = $dominios->id;
            $config->Cat_distribuidor_id = $request->input('Cat_Distribuidor_id');
            $config->save();
            /**
             * Recuperamos todos los modulos que esten activos
             */
            $modulos = Modulos::where('activo',1)->get();
            /**
             * Reciclamos variables
             */
            $idEmpresa = $request->input('id_empresa');
            $nombreEmpresa = str_replace( '_', ' ',  $request->input('dominio') );

            return view('administrador::empresas.modulos', compact('idEmpresa', 'nombreEmpresa', 'modulos') );

        } else if($request->input('action') == 'dataModulo') {
            /**
             * Buscamos la empresa
             */
            $empresa = Empresas::findOrFail($request->input('id_empresa'));
            $empresa->modulos()->attach( $request->input('arr') );
        }
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administrador::empresas.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /**
         * Recuperamos todos los distribuidores que esten activos
         */
        $distribuidores = Cat_Distribuidor::where('activo',1)->get();
        /**
         * Buscamos la empresa ha editar
         */
        $empresa = Empresas::findOrFail($id);
        return view('administrador::empresas.edit', compact('empresa', 'distribuidores'));
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
        $dataForm = $request->input('dataForm');
        for ($i=0; $i < count( $dataForm ); $i++) {
            $data[ $dataForm[$i]['name'] ] = $dataForm[$i]['value'];
        }
        /**
         *
         */
        if ($data['action'] == "dataEmpresa" ) {
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

        } else if($data['action'] == 'dataInfra') {
            /**
             * Creamos el nuevo dominio
             */
            if ($data['Cat_Distribuidor_id'] == 11) {
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


        } else if($data['action'] == 'dataModulo') {
            /**
             * Buscamos la empresa
             */
            $empresa = Empresas::findOrFail($request->input('id_empresa'));
            $empresa->modulos()->attach( $request->input('arr') );
        }

        print_r( $data['action'] );
        //dd( $dataForm );
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
