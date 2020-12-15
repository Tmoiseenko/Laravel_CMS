<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'slug' => Str::slug($faker->sentence(2), '-'),
        'excerpt' => $faker->sentence(10),
        'content' => $faker->paragraph(rand(10, 30), ),
        'published' => rand(0, 1),
    ];
});
