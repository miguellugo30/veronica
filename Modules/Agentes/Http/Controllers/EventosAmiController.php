<?php

namespace Modules\Agentes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PHPAMI\Ami;

class EventosAmiController extends Controller
{
    public static function colgar_llamada( $canal )
    {
        $ami = new Ami();
        if ($ami->connect('10.255.242.136:5038', 'Call_Center', 'Call_C3nt3r_1nf1n1t', 'off') === false) {
            throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
        }

        $ami->command('hangup request '.$canal);

        $ami->disconnect();
    }
}
