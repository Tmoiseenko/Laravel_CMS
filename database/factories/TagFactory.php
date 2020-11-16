<?php

use App\Post;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(1)
    ];
});