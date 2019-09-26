<?php

namespace Nimbus\Console\Commands;

use Illuminate\Console\Command;
use Nimbus\Token_Soporte;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TokensSoporte extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:soporte';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarea que eliminar los token que ya expiro su caducidad';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $tokens = Token_Soporte::all();

        foreach ($tokens as $token) {

            $caducidad = Carbon::parse( $token->caducidad );

            if ( $caducidad->lessThanOrEqualTo(date('Y-m-d H:i:s')) ) {

                Token_Soporte::where('id',$token->id )->delete();
                Log::info('Token eliminado: '.$token->token);

            }
        }
    }
}
