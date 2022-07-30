<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'user_name' => $this -> faker -> name,
        'email' => $this -> faker -> email,
        'password' => $this -> faker -> password,
    ];
});
