<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class modulosSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('modulos')->delete();

        $nombre = array(
                        'Inbound',
                        'Outbound',
                        'Monitor & Coaching',
                        'Recording Suite',
                        'Intelligent IVR',
                        'Survey Generator',
                        'Billing',
                        'Voice Message',
                        'Buzon de Voz',
                        'Conference & Meetme',
                        'SMS Server',
                        'Settings',
                        'Administrador'
                    );

        $descripcion = array(
                            'Campanas de Entrada',
                            'Campanas de Salida',
                            'Monitoreo de Llamadas de los Agentes',
                            'Grabacion de Llamadas',
                            'Intelligent IVR',
                            'Generador automatico de encuestas',
                            'Tarificador de Llamadas',
                            'Generador automatico de mensajes de voz',
                            'Buzon de Voz',
                            'Conference & Meetme',
                            'Campanas de envio de Mensajeria',
                            'Configuraciones Generales de la Suite',
                            'Administración del sistema'
                        );

        for ($i=0; $i < count( $nombre ); $i++)
        {
            DB::table('modulos')->insert([
                'nombre' => $nombre[$i],
                'descripcion' => $descripcion[$i],
                'prioridad' => $i+1,
                'activo' => 1
            ]);
        }
    }
}
