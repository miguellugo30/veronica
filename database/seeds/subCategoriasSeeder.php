<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class subCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categorias')->delete();

        $json = File::get('database/data/sub_categorias.json');
        $data = json_decode($json);
        foreach( $data as $obj )
        {
            DB::table('sub_categorias')->insert([
                                            'nombre' => $obj->nombre,
                                            'descripcion' => $obj->descripcion,
                                            'permiso' => $obj->permiso,
                                            'prioridad' => $obj->prioridad,
                                            'tipo' => (int)$obj->tipo,
                                            'activo' => (int)$obj->activo,
                                            'id_categoria' => $obj->id_categoria
                                        ]);
        }
    }
}
