<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'company_id' => $faker -> numberBetween($min=1,$max=3),
        'product_name' => $faker -> name,
        'price' => $faker -> numberBetween($min = 100, $max = 500),
        'stock' => $faker -> numberBetween($min = 100, $max = 500),
        'comment' => $faker -> text,
        'img_path' => $faker -> image,
    ];
});
