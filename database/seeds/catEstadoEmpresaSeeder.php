<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class catEstadoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_estado_empresa')->delete();

        $json = File::get('database/data/cat_estado_empresa.json');
        $data = json_decode($json);
        foreach( $data as $obj )
        {
            DB::table('cat_estado_empresa')->insert([
                                        'nombre' => $obj->nombre,
                                        'activo' => (int)$obj->activo
                                            ]);
        }
    }
}
