<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class empresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( Faker $faker )
    {
        $empresaID = DB::table('Empresas')
                            ->insertGetId([
                                'nombre' => 'Veronica',
                                'contacto_cliente' => "Miguel Chavez Lugo",
                                'direccion' => $faker->secondaryAddress,
                                'ciudad' => $faker->city,
                                'estado' => $faker->state,
                                'pais' => 'Mexico',
                                'telefono' => '5555555555',
                                'movil' => '55555555555',
                                'correo' => 'ingmchlugo@gmail.com',
                                'activo' => 1,
                                'Cat_Estado_Empresa_id' => 1
                            ]);

        $user = User::create([
                                'name' => 'Miguel Chavez Lugo',
                                'email' => 'ingmchlugo@gmail.com',
                                'password' => Hash::make('admin'),
                                'id_cliente' => $empresaID
                            ]);

        $user->assignRole('Super Administrador');

        $permisos = array(
                            'view usuarios',
                            'edit usuarios',
                            'create usuarios',
                            'delete usuarios',
                            'view confi sistema'
                        );

        $user->syncPermissions( $permisos );

        DB::table('modulos_empresas')->insert([
            'empresa_id' => $empresaID,
            'modulos_id' => 13
        ]);

    }
}
