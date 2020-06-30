<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class rolesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('model_has_roles')->delete();

        $json = File::get('database/data/roles.json');
        $data = json_decode($json);
        foreach( $data as $obj )
        {
            DB::table('roles')->insert([
                                        'name' => $obj->name,
                                        'guard_name' => $obj->guard_name
                                            ]);
        }
    }
}
