<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(catEstadoEmpresaSeeder::class);
        $this->call(permissionsSeeder::class);
        $this->call(rolesSedeer::class);
        $this->call(modulosSedeer::class);
        $this->call(categoriasSeeder::class);
        $this->call(subCategoriasSeeder::class);
        $this->call(empresaSeeder::class);
    }
}
