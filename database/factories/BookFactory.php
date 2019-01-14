<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(200),
        'user_id' => $faker->randomElement([5, 6, 10]), //writer user IDs
    ];
});
