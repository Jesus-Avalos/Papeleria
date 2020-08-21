<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cliente::create([
            'nombre' => 'Cliente Mostrador',
            'direccion' => 'Lejos #21',
            'telefono' => '1231231233',
            'email' => 'cliente@mail.com'
        ]);
        factory(\App\Models\Categoria::class,10)->create();
        factory(\App\Models\Cliente::class,15)->create();
        factory(\App\Models\Producto::class,20)->create();
    }
}
