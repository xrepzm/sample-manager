<?php

use Faker\Generator;
use SampleManager\Models\Request;
use SampleManager\Models\Sample;
use SampleManager\User;

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Sample::class, function (Generator $faker) {
    return [
        'charge' => str_random(rand(1, 32)),
        'productcode' => $faker->numberBetween(1e7, 9e7),
        'itemcode' => $faker->unique()->numberBetween(2e5, 4e5),
        'productname' => str_random(rand(1, 64)),
        'quantity' => $faker->randomFloat(3, 1, 3e3),
        'unit' => str_random(rand(1, 5)),
        'sampled_at' => $faker->dateTimeBetween('-3 years', 'now'),
        'expiry' => $faker->dateTimeBetween('-1 year', '+3 years'),
        'rejected_at' => $faker->dateTimeBetween('-2 years', 'now'),
    ];
});

$factory->define(Request::class, function (Generator $faker) {
    static $user_id;

    return [
        'user_id' => $user_id ?: factory(User::class)->create()->id,
        'title' => str_random(rand(1, 64)),
        'description' => $faker->sentence(3, true),
    ];
});
