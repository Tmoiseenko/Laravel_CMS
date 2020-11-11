<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Post::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('zh_CN');
    return [
        'title' => $faker->sentence(5),
        'slug' => Str::slug($faker->sentence(2), '-'),
        'excerpt' => $faker->sentence(10),
        'content' => $faker->paragraph(rand(10, 30), ),
        'published' => rand(0, 1),
        'user_id' => factory(\App\User::class)->create(),
    ];
});
