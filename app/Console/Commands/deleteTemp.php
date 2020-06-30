<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class deleteTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:tmp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borra todos los archivos de la carpeta temporal';

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
        $files = Storage::disk('public')->files('tmp/');

        for ($i=0; $i < count( $files ); $i++) {
            Storage::disk('public')->delete( $files[$i] );
        }

        Log::info('Se ha borrado información del directorio temporal');
    }
}
