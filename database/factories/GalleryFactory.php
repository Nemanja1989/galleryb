<?php

use Faker\Generator as Faker;

$factory->define(\App\Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->text(60),
        'description' => $faker->text(80),
        'author_id' => \App\User::all()->random()->id
    ];
});
