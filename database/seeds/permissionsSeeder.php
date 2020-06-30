<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class permissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('model_has_permissions')->delete();

        $json = File::get('database/data/permissions.json');
        $data = json_decode($json);
        foreach( $data as $obj )
        {
            DB::table('permissions')->insert([
                                        'name' => $obj->name,
                                        'guard_name' => $obj->guard_name
                                            ]);
        }
    }
}
