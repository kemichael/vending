<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'company_name' => $faker -> company,
        'street_address' => $faker -> address,
        'representative_name' => $faker -> name,
    ];
});
