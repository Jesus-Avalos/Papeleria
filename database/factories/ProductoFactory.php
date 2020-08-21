<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence(2),
        'descripcion' => $faker->text(50),
        'categoria_id' => rand(1,10),
        'precio_compra' => rand(1,25),
        'precio_venta' => rand(25,50),
        'stock' => rand(10,20)
    ];
});
