<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 22.2.18.
 * Time: 18.34
 */


use Faker\Generator as Faker;

$factory->define(\App\Picture::class, function (Faker $faker) {
    $gallery_id = \App\Gallery::all()->random()->id;

    static $order = 1;

    return [
        'picture_url' => $faker->imageUrl(),
        'gallery_id' => $gallery_id,
        'order' => $order++
    ];
});
