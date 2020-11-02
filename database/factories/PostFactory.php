<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Post::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('zh_CN');
    return [
        'title' => $faker->realText(10),
        'slug' => Str::slug($faker->sentence(2), '-'),
        'excerpt' => $faker->realText(50),
        'content' => $faker->realText(),
        'published' => rand(0, 1),
    ];
});