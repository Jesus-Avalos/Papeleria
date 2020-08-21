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
        factory(\App\Models\Categoria::class,10)->create();
        factory(\App\Models\Cliente::class,15)->create();
        factory(\App\Models\Producto::class,20)->create();
    }
}
