<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class categoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->delete();

        $json = File::get('database/data/categorias.json');
        $data = json_decode($json);
        foreach( $data as $obj )
        {
            DB::table('categorias')->insert([
                                        'nombre' => $obj->nombre,
                                        'descripcion' => $obj->descripcion,
                                        'prioridad' => $obj->prioridad,
                                        'class_icon' => $obj->class_icon,
                                        'permiso' => $obj->permiso,
                                        'tipo' => (int)$obj->tipo,
                                        'activo' => (int)$obj->activo,
                                        'modulos_id' => (int)$obj->modulos_id
                                            ]);
        }
    }
}
